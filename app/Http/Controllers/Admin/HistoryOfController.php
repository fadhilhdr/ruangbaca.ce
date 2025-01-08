<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\Visitor;
use Illuminate\Http\Request;

class HistoryOfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showTransaction()
    {
        $transactions = Transaction::with(['bookLoan.book', 'bookLoan.user', 'type'])
            ->latest() // Mengurutkan berdasarkan kolom created_at secara descending
            ->take(3) // Membatasi hanya 3 data terbaru
            ->get();

        return view('admin.transaksi.index', compact('transactions'));
    }

    public function index()
    {
        // $totalUsers = User::count(); // Menghitung total pengguna

        // Menghitung jumlah buku yang tersedia (is_available = 1)
        $availableBooks = Book::where('is_available', 1)->count();

        // Menghitung jumlah buku yang dipinjam (is_available = 0)
        $borrowedBooks = Book::where('is_available', 0)->count();

        $totalStudents = Student::count();
        $totalVisitor = Visitor::count();

        // Menampilkan tabel transaksi
        $transactions = Transaction::with(['bookLoan.user', 'bookLoan', 'type'])->get();

        return view('admin.dashboard.index', compact('availableBooks', 'borrowedBooks', 'totalVisitor', "totalStudents", "transactions"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}