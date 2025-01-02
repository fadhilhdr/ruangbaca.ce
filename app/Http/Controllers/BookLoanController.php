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

class BookLoanController extends Controller
{
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
                        ->with(['book', 'transactions'])
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
        return view('member.loans.borrowForm', compact('bookReference'));
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
        $loan = BookLoan::with('book')->findOrFail($id);
        
        // Calculate late days and fine if applicable
        $daysLate = 0;
        $fineAmount = 0;
        $isLate = false;
        
        if ($loan->due_date < now()) {
            $isLate = true;
            $daysLate = now()->diffInDays(Carbon::parse($loan->due_date));
            $fineAmount = $daysLate * 1000; // Rp1.000 per day
        }

        // Check if there are any pending fines
        $hasPendingFine = Fine::where('book_loan_id', $loan->id)
            ->whereNotIn('status', ['verified'])
            ->exists();
        
        return view('member.loans.returnForm', compact('loan', 'isLate', 'daysLate', 'fineAmount', 'hasPendingFine'));
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
    
    private function createFineTransaction(BookLoan $loan, $fineAmount)
    {
        // Get or create fine transaction type
        $transactionType = TransactionType::where('type_name', 'fine')->firstOrFail();
    
        // Create fine transaction
        $transaction = Transaction::create([
            'book_loan_id' => $loan->id,
            'transaction_type_id' => $transactionType->id,
        ]);
    
        // Create fine record
        Fine::create([
            'transaction_id' => $transaction->id,
            'book_loan_id' => $loan->id,
            'amount' => $fineAmount,
            'status' => 'pending', // initial status before bukti_tf upload
        ]);
    
        return $transaction;
    }
    
    public function returnBook(Request $request, $id)
    {
        $request->validate([
            'kode_unik_buku' => 'required',
            'terms' => 'required|accepted',
            'bukti_tf' => 'required_if:isLate,true|file|image|max:2048'
        ]);
    
        try {
            DB::beginTransaction();
    
            $loan = BookLoan::with('book')->findOrFail($id);
    
            // Validate if the book code matches
            if ($loan->kode_unik_buku !== $request->kode_unik_buku) {
                return back()->with('error', 'Kode unik buku tidak sesuai.');
            }
    
            // Check if there are any unverified fines
            $hasUnverifiedFines = Fine::where('book_loan_id', $loan->id)
                ->whereNotIn('status', ['verified'])
                ->exists();
    
            if ($hasUnverifiedFines) {
                return back()->with('error', 'Anda memiliki denda yang belum diverifikasi.');
            }
    
            // Calculate late days and fine if applicable
            $isLate = $loan->due_date < now();
            if ($isLate) {
                $daysLate = now()->diffInDays(Carbon::parse($loan->due_date));
                $fineAmount = $daysLate * 1000;
    
                // Create fine transaction
                $transaction = $this->createFineTransaction($loan, $fineAmount);
    
                // Handle bukti transfer upload
                if ($request->hasFile('bukti_tf')) {
                    $path = $request->file('bukti_tf')->store('public/bukti-transfer');
                    $fine = Fine::where('transaction_id', $transaction->id)->first();
                    $fine->update([
                        'bukti_tf' => str_replace('public/', '', $path),
                        'status' => 'awaiting_verif'
                    ]);
                }
            }
    
            // Create return transaction
            $returnTransactionType = TransactionType::where('type_name', 'return')->firstOrFail();
            Transaction::create([
                'book_loan_id' => $loan->id,
                'transaction_type_id' => $returnTransactionType->id,
            ]);
    
            // Update loan status
            $loan->update([
                'return_date' => now()
            ]);
    
            // Update book availability
            $loan->book->update([
                'is_available' => true
            ]);
    
            DB::commit();
    
            return redirect()->route('member.loans.index')
                ->with('success', $isLate ? 
                    'Buku berhasil dikembalikan. Pembayaran denda menunggu verifikasi admin.' : 
                    'Buku berhasil dikembalikan.'
                );
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan dalam proses pengembalian buku.');
        }
    }

    public function reportLost(Request $request, $id)
    {
        try {
            DB::beginTransaction();
    
            $loan = BookLoan::findOrFail($id);
    
            // Create lost book record
            LostBook::create([
                'book_loan_id' => $loan->id,
                'status' => 'reported',
                'report_date' => now()
            ]);
    
            // Create lost book transaction
            $lostTransactionType = TransactionType::where('type_name', 'lost')->firstOrFail();
            Transaction::create([
                'book_loan_id' => $loan->id,
                'transaction_type_id' => $lostTransactionType->id,
            ]);
    
            // Update book status
            $loan->book->update([
                'status' => 'lost'
            ]);
    
            DB::commit();
    
            return redirect()->route('member.loans.show', $loan->id)
                ->with('info', 'Laporan buku hilang telah diterima. Silakan hubungi petugas untuk proses selanjutnya.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan dalam melaporkan buku hilang.');
        }
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
}