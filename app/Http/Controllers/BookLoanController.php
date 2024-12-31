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
    
    public function showBorrowForm($id)
    {
        $book = Book::findOrFail($id);
        return view('member.loans.borrowForm', compact('book'));
    } 

    public function showReturnForm($id)
    {
        $loan = BookLoan::with('book')->findOrFail($id); 
        return view('member.loans.returnForm', compact('loan'));
    }

    private function hasMaxActiveLoans()
    {
        $activeLoans = BookLoan::where('user_id', auth()->id())
                               ->whereNull('return_date')
                               ->count();
    
        return $activeLoans >= 2;
    }     

    //Membuat bookloan, dan transaction
    private function createLoan(Book $book)
    {
        DB::beginTransaction();
    
        try {
            $loan = BookLoan::create([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'loan_date' => now(),
                'due_date' => now()->addDays(14),
                'renewal_count' => 0,
            ]);
    
            $transactionType = TransactionType::where('type_name', 'borrow')->first();
            if (!$transactionType) {
                throw new \Exception('Tipe transaksi borrow tidak ditemukan');
            }

            Transaction::create([
                'book_loan_id' => $loan->id,
                'transaction_type_id' => $transactionType->id,
            ]);
    
            DB::commit();
            return $loan;
    
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function borrowBook(Request $request, $id)
    {
        DB::beginTransaction();
    
        try {
            $book = Book::findOrFail($id);
    
            if ($book->getAvailableStock()<= 0) {
                return back()->with('error', 'Buku ini sedang tidak tersedia untuk dipinjam.');
            }
    
            if ($this->hasMaxActiveLoans()) {
                return back()->with('error', 'Anda sudah mencapai batas maksimum peminjaman buku.');
            }

            $loan = $this->createLoan($book);
            $book->decrement('available_stock',1);
    
            DB::commit();
    
            return redirect()->route('member.loans.index', $loan->id)
                             ->with('success', 'Buku berhasil dipinjam.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    
    private function createFineTransaction(BookLoan $loan, $fineAmount)
    {
        DB::beginTransaction();
    
        try {
            // Create transaction type for Fine Payment
            $transactionType = TransactionType::where('type_name', 'Fine Payment')->firstOrFail();
    
            // Buat transaksi pembayaran denda
            $fineTransaction = Transaction::create([
                'book_loan_id' => $loan->id,
                'transaction_type_id' => $transactionType->id,
            ]);
    
            // Buat record denda
            $fine = Fine::create([
                'transaction_id' => $fineTransaction->id,
                'book_loan_id' => $loan->id,
                'amount' => $fineAmount,
                'status' => 'awaiting_verif', // Status menunggu verifikasi admin
            ]);
    
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
    public function returnBook(Request $request, $id)
    {
        DB::beginTransaction();
    
        try {
            // Cari BookLoan berdasarkan ID yang diberikan
            $loan = BookLoan::findOrFail($id);
    
            // 1. Validasi User ID yang cocok (autentikasi user)
            if ($loan->user_id !== auth()->id()) {
                return back()->with('error', 'Buku ini bukan peminjaman Anda.');
            }
    
            // 2. Validasi apakah buku sudah jatuh tempo
            if ($loan->due_date < now()) {
                $lateDays = now()->diffInDays($loan->due_date);
                $fineAmount = $lateDays * 1000; // Hitung denda
    
                // Cek apakah sudah ada transaksi denda yang dibuat untuk book loan ini
                $fineTransaction = Transaction::where('book_loan_id', $loan->id)
                                              ->where('transaction_type_id', TransactionType::where('type_name', 'Fine Payment')->first()->id)
                                              ->latest()
                                              ->first();
    
                // 3. Jika terlambat dan belum ada pembayaran atau verifikasi
                if ($fineTransaction) {
                    $fine = $fineTransaction->fines()->latest()->first();
                    
                    // Cek status pembayaran denda
                    if (!$fine || !$fine->isVerified()) {
                        return back()->with('error', 'Harap bayar denda terlebih dahulu sebesar IDR ' . $fineAmount);
                    }
                } else {
                    // Jika belum ada transaksi denda, buat transaksi denda
                    $this->createFineTransaction($loan, $fineAmount);
                    return back()->with('error', 'Harap bayar denda terlebih dahulu sebesar IDR ' . $fineAmount);
                }
            }
    
            // 4. Validasi apakah ID buku yang dikembalikan cocok
            // if ($request->input('book_id') != $bookLoan->book_id) {
            //     // Jika buku hilang, arahkan ke proses penggantian
            //     return redirect()->route('member.loans.book-replacement', $id)
            //                      ->with('error', 'Buku tidak sesuai, harap lakukan penggantian buku.');
            // }
    
            // 5. Jika semua syarat terpenuhi, lakukan pengembalian
            $loan->return_date = now();
            $loan->save();
    
            // 6. Update stok buku
            $book = $loan->book;
            $book->increment('available_stock', 1);
    
            // 7. Create transaksi untuk pengembalian
            $transactionType = TransactionType::where('type_name', 'Return')->firstOrFail();
            Transaction::create([
                'book_loan_id' => $loan->id,
                'transaction_type_id' => $transactionType->id,
            ]);
    
            // Commit transaksi DB
            DB::commit();
    
            return redirect()->route('member.loans.index')->with('success', 'Buku berhasil dikembalikan.');
        
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    


    public function history()
    {
        $loans = BookLoan::where('user_id', auth()->id())
                            ->whereNotNull('return_date')
                            ->with(['book', 'transactions'])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);
    
        if ($loans->isEmpty()) {
            return view('member.loans.history', compact('loans'))->with('info', 'No loan history found.');
        }
    
        return view('member.loans.history', compact('loans'));
    }

}