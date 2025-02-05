<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\Fine;
use App\Models\LostBook;
use App\Models\Transaction;
use App\Models\TransactionType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookLoanController extends Controller
{
    public function dashboard()
    {
       // Get active lost book cases
       $hasActiveLostBook = LostBook::whereHas('bookLoan', function($q) {
           $q->where('user_id', auth()->id());
       })->whereIn('replacement_status', ['awaiting_verif', 'declined'])->exists();
    
       $allLoans = BookLoan::where('user_id', auth()->id())
           ->with(['book', 'lostBook']) 
           ->whereNotNull('loan_date')
           ->orderByDesc('loan_date')
           ->take(5)
           ->get()
           ->map(function($loan) {
               $loan->status = $this->getLoanStatus($loan);
               return $loan;
           });
    
       $activeLoanCount = BookLoan::where('user_id', auth()->id())
           ->whereNull('return_date')
           ->count();
    
       $lateLoanCount = BookLoan::where('user_id', auth()->id())
           ->whereNull('return_date')
           ->where('due_date', '<', now())
           ->count();
    
       $remainingQuota = 2 - $activeLoanCount;
    
       return view('member.dashboard', compact(
           'allLoans',
           'activeLoanCount', 
           'lateLoanCount',
           'remainingQuota',
           'hasActiveLostBook'
       ));
    }

    private function getLoanStatus($loan)
    {
        if ($loan->return_date) {
            return [
                'label' => 'Returned',
                'class' => 'bg-green-100 text-green-800'
            ];
        }

        if ($loan->due_date < now()) {
            return [
                'label' => 'Late',
                'class' => 'bg-red-100 text-red-800'
            ];
        }

        if ($loan->due_date <= now()->addDays(3)) {
            return [
                'label' => 'Due Soon',
                'class' => 'bg-yellow-100 text-yellow-800'
            ];
        }

        return [
            'label' => 'Active',
            'class' => 'bg-blue-100 text-blue-800'
        ];
    }

    public function index()
    {
        $loans = BookLoan::where('user_id', auth()->id())
                            ->whereNull('return_date')
                            ->with('book')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        if ($loans->isEmpty()) {
            return view('member.loans.index', compact('loans'))->with('info', 'No active loans found.');
        }

        return view('member.loans.index', compact('loans'));
    }

    public function show($id)
    {
        $loan = BookLoan::where('user_id', auth()->id())
                        ->with(['book', 'transactions.type'])
                        ->findOrFail($id);

        $isLate = $loan->due_date < now();
        $canRenew = $loan->renewal_count < 1 && !$isLate && !$loan->return_date;

        // Ensure user has access to this loan
        if (!$loan) {
            return redirect()->route('member.loans.index')->with('error', 'Loan not found.');
        }

        return view('member.loans.show', compact('loan', 'isLate', 'canRenew'));
    }

    public function showBorrowForm($isbn)
    {
        $bookReference = Book::where('isbn', $isbn)->firstOrFail();
        $hasActiveLostBook = LostBook::whereHas('bookLoan', function($query) {
            $query->where('user_id', auth()->id());
        })->whereIn('replacement_status', ['awaiting_verif', 'declined'])
          ->exists();
          return view('member.loans.borrowForm', compact('bookReference', 'hasActiveLostBook'));
    }

    public function showRenewForm($id)
    {
        $loan = BookLoan::with('book')->findOrFail($id);

        // Check if loan is eligible for renewal
        if (!$loan->canRenew()) {
            return redirect()->route('member.loans.show', $loan->id)
                ->with('error', 'Peminjaman ini tidak dapat diperpanjang. Pastikan belum pernah diperpanjang dan masih dalam masa peminjaman.');
        }

        return view('member.loans.renewForm', compact('loan'));
    }

    public function showReturnForm($id)
    {
        $loan = BookLoan::findOrFail($id);
        $isLate = Carbon::now()->greaterThan($loan->due_date);
        $daysLate = $isLate ? Carbon::now()->diffInDays($loan->due_date) : 0;
        $fineAmount = $daysLate * 1000; // Rp1.000 per day

        return view('member.loans.returnForm', compact('loan', 'isLate', 'daysLate', 'fineAmount'));
    }


    public function showPaymentForm($id)
    {
        $loan = BookLoan::findOrFail($id);

        // Check if there's an existing unpaid fine
        $existingFine = Fine::where('book_loan_id', $loan->id)
            ->where('status', '!=', 'verified')
            ->first();

        if ($existingFine) {
            return redirect()->route('member.loans.returnForm', $loan->id)
                ->with('error', 'Sudah ada pembayaran denda yang sedang diproses');
        }

        $daysLate = Carbon::now()->diffInDays($loan->due_date);
        $fineAmount = $daysLate * 1000;

        return view('member.loans.paymentForm', compact('loan', 'daysLate', 'fineAmount'));
    }

    public function showReplacementForm($id)
    {
        $loan = BookLoan::findOrFail($id);

        // Check if there's an existing replacement request
        $existingRequest = LostBook::where('book_loan_id', $loan->id)->first();

        if ($existingRequest) {
            return redirect()->route('member.loans.returnForm', $loan->id)
                ->with('error', 'Sudah ada laporan kehilangan buku yang sedang diproses');
        }

        return view('member.loans.replacementForm', compact('loan'));
    }


    public function validateKodeUnik($kode, $isbn)
    {
        $book = Book::where('kode_unik', $kode)
                    ->where('isbn', $isbn)
                    ->where('is_available', true)
                    ->first();

        return response()->json([
            'valid' => $book !== null,
            'message' => $book !== null ?
                'Kode unik valid dan buku tersedia' :
                'Kode unik tidak valid atau buku tidak tersedia'
        ]);
    }

    // API endpoint for validating renewal kode unik
    public function validateRenewKodeUnik($kodeUnik, $loanId)
    {
        try {
            $loan = BookLoan::findOrFail($loanId);

            $isValid = $kodeUnik === $loan->kode_unik_buku;
            $canRenew = $loan->canRenew();

            if (!$isValid) {
                return response()->json([
                    'valid' => false,
                    'message' => 'Kode unik tidak sesuai dengan buku yang dipinjam.'
                ]);
            }

            if (!$canRenew) {
                return response()->json([
                    'valid' => false,
                    'message' => 'Buku ini tidak dapat diperpanjang. Pastikan belum pernah diperpanjang dan masih dalam masa peminjaman.'
                ]);
            }

            return response()->json([
                'valid' => true,
                'message' => 'Kode unik valid. Buku dapat diperpanjang.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'valid' => false,
                'message' => 'Terjadi kesalahan dalam validasi kode unik.'
            ], 500);
        }
    }

    public function validateReturnKodeUnik($kodeUnik, $loanId)
    {
        try {
            $loan = BookLoan::findOrFail($loanId);

            $isValid = $kodeUnik === $loan->kode_unik_buku;

            if (!$isValid) {
                return response()->json([
                    'valid' => false,
                    'message' => 'Kode unik tidak sesuai dengan buku yang dipinjam.'
                ]);
            }

            return response()->json([
                'valid' => true,
                'message' => 'Kode unik valid.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'valid' => false,
                'message' => 'Terjadi kesalahan dalam validasi kode unik.'
            ], 500);
        }
    }

public function borrowBook(Request $request, $isbn)
{
    // Single check for lost book at the beginning
    $hasActiveLostBook = LostBook::whereHas('bookLoan', function($query) {
        $query->where('user_id', auth()->id());
    })->whereIn('replacement_status', ['awaiting_verif', 'declined'])
      ->exists();

    if ($hasActiveLostBook) {
        return back()->with('error', 'Anda memiliki kasus kehilangan buku yang belum terselesaikan. Silahkan selesaikan proses penggantian buku terlebih dahulu.');
    }

    $request->validate([
        'kode_unik_buku' => 'required|exists:books,kode_unik',
        'terms' => 'required|accepted'
    ]);

    try {
        DB::beginTransaction();
        
            // Check if the book exists and is available
            $book = Book::where('kode_unik', $request->kode_unik_buku)
                        ->where('isbn', $isbn)
                        ->where('is_available', true)
                        ->lockForUpdate()
                        ->first();
    
            if (!$book) {
                return back()->with('error', 'Buku tidak tersedia atau kode unik tidak sesuai.');
            }
    
            // Check if user has reached maximum loan limit (2 books)
            $activeLoans = BookLoan::where('user_id', auth()->id())
                                  ->whereNull('return_date')
                                  ->count();
    
            if ($activeLoans >= 2) {
                return back()->with('error', 'Anda telah mencapai batas maksimum peminjaman (2 buku).');
            }
    
            // Create new loan
            $loan = BookLoan::create([
                'kode_unik_buku' => $request->kode_unik_buku,
                'user_id' => auth()->id(),
                'loan_date' => now(),
                'due_date' => now()->addDays(14),
                'renewal_count' => 0
            ]);
    
            $transactionType = TransactionType::where('type_name', 'borrow')->first();
            if (!$transactionType) {
                throw new \Exception('Tipe transaksi borrow tidak ditemukan');
            }
    
            Transaction::create([
                'book_loan_id' => $loan->id,
                'transaction_type_id' => $transactionType->id,
            ]);
    
            // Update book availability
            $book->update(['is_available' => false]);
    
            DB::commit();
    
            return redirect()->route('member.loans.index')
                           ->with('success', 'Buku berhasil dipinjam. Harap kembalikan sebelum ' .
                                           now()->addDays(14)->format('d M Y H:i'));
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan dalam proses peminjaman.');
        }
    }

    public function renewBook(Request $request, $id)
    {
        $request->validate([
            'kode_unik_buku' => 'required',
            'terms' => 'required|accepted'
        ]);

        try {
            DB::beginTransaction();

            $loan = BookLoan::with('book')->findOrFail($id);

            // Validate if the book code matches
            if ($loan->kode_unik_buku !== $request->kode_unik_buku) {
                return back()->with('error', 'Kode unik buku tidak sesuai.');
            }

            // Check if loan can be renewed
            if (!$loan->canRenew()) {
                return back()->with('error', 'Peminjaman ini tidak dapat diperpanjang.');
            }

            // Update loan due date and renewal count
            $loan->update([
                'due_date' => Carbon::parse($loan->due_date)->addDays(7),
                'renewal_count' => $loan->renewal_count + 1
            ]);

            // Create renewal transaction record
            $transactionType = TransactionType::where('type_name', 'renewal')->first();
            if (!$transactionType) {
                throw new \Exception('Tipe transaksi renewal tidak ditemukan');
            }

            Transaction::create([
                'book_loan_id' => $loan->id,
                'transaction_type_id' => $transactionType->id,
            ]);

            DB::commit();

            return redirect()->route('member.loans.show', $loan->id)
                ->with('success', 'Peminjaman berhasil diperpanjang hingga ' .
                    Carbon::parse($loan->due_date)->format('d M Y H:i'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan dalam proses perpanjangan.');
        }
    }

    public function returnBook(Request $request, $id)
    {
        $loan = BookLoan::findOrFail($id);

        $request->validate([
            'kode_unik_buku' => 'required|string',
            'terms' => 'required|accepted'
        ]);

        // Validate unique code
        if ($request->kode_unik_buku !== $loan->kode_unik_buku) {
            return back()->with('error', 'Kode unik buku tidak sesuai');
        }

        // Check if there are unpaid fines
        if ($loan->isLate() && !$loan->hasPaidFine()) {
            return back()->with('error', 'Harap selesaikan pembayaran denda terlebih dahulu');
        }

        // Create return transaction record
        $transactionType = TransactionType::where('type_name', 'Return')->first();
        if (!$transactionType) {
            throw new \Exception('Tipe transaksi Return tidak ditemukan');
        }

        Transaction::create([
            'book_loan_id' => $loan->id,
            'transaction_type_id' => $transactionType->id,
        ]);

        // Process return
        $loan->update([
            'return_date' => now(),
            'status' => 'returned'
        ]);

        // Update book availability
        $loan->book->update(['is_available' => true]);

        return redirect()->route('member.loans.index')
            ->with('success', 'Buku berhasil dikembalikan');
    }

    public function history(Request $request)
    {
        $query = BookLoan::where('user_id', auth()->id())
            ->with(['book', 'transactions.type', 'transactions.fines'])
            ->orderBy('created_at', 'desc');

        // Apply transaction type filter if selected
        if ($request->filled('transaction_type')) {
            $query->whereHas('transactions.type', function($q) use ($request) {
                $q->where('type_name', $request->transaction_type);
            });
        }

        // Apply date range filter if selected
        if ($request->filled(['date_from', 'date_to'])) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->date_from)->startOfDay(),
                Carbon::parse($request->date_to)->endOfDay()
            ]);
        }

        $loans = $query->paginate(10)->withQueryString();

        // Get transaction types for filter dropdown
        $transactionTypes = TransactionType::pluck('type_name', 'type_name');

        return view('member.loans.history', compact('loans', 'transactionTypes'));
    }

    public function storeReplacement(Request $request, $id)
    {
        $loan = BookLoan::findOrFail($id);

        $request->validate([
            'description' => 'required|string|min:10',
            'agreement' => 'required|accepted'
        ]);

        // Create Lost Book Replacement transaction record
        $transactionType = TransactionType::where('type_name', 'Lost Book Replacement')->first();
        if (!$transactionType) {
            throw new \Exception('Tipe transaksi Lost Book Replacement tidak ditemukan');
        }

        Transaction::create([
            'book_loan_id' => $loan->id,
            'transaction_type_id' => $transactionType->id,
        ]);

        LostBook::create([
            'book_loan_id' => $loan->id,
            'date_reported' => now(),
            'description' => $request->description,
            'replacement_status' => 'awaiting_verif'
        ]);

        return redirect()->route('member.loans.show', $loan->id)
            ->with('success', 'Laporan kehilangan buku berhasil diajukan');
    }

    public function storePayment(Request $request, $id)
    {
        $loan = BookLoan::findOrFail($id);

        // Validasi bukti transfer
        $request->validate([
            'bukti_tf' => 'required|image|max:2048',
        ]);

        // Cek apakah ada denda yang harus dibayar
        $daysLate = Carbon::now()->diffInDays($loan->due_date);
        if ($daysLate <= 0) {
            return redirect()->route('member.loans.returnForm', $loan->id)
                             ->with('error', 'Tidak ada denda yang harus dibayar.');
        }
        // Hitung jumlah denda
        $fineAmount = $daysLate * 1000;

        // Store bukti pembayaran
        $path = $request->file('bukti_tf')->store('public/bukti-transfer');

        // Menyimpan transaksi pembayaran denda
        $transactionType = TransactionType::where('type_name', 'Fine Payment')->firstOrFail();

        // Buat transaksi denda
        $transaction = Transaction::create([
            'book_loan_id' => $loan->id,
            'transaction_type_id' => $transactionType->id,
        ]);

        // Buat entri denda
        Fine::create([
            'transaction_id' => $transaction->id,
            'book_loan_id' => $loan->id,
            'amount' => $fineAmount,
            'status' => 'awaiting_verif', // Status awal denda
            'bukti_tf' => $path,
            'paid_at' => now(), // Jika sudah dibayar, set tanggal pembayaran
        ]);

        return redirect()->route('member.loans.returnForm', $loan->id)
                         ->with('success', 'Bukti pembayaran denda berhasil diupload dan sedang diverifikasi');
    }

}