<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query()
            ->select('isbn', 'judul', 'penulis', 'penerbit', 'peminatan', 'sub_peminatan', 'thumbnail', 'synopsis')
            ->selectRaw('COUNT(CASE WHEN is_available = true THEN 1 END) as available_stock')
            ->groupBy('isbn', 'judul', 'penulis', 'penerbit', 'peminatan', 'sub_peminatan', 'thumbnail', 'synopsis');

        // Search logic
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', '%' . $keyword . '%')
                    ->orWhere('penulis', 'like', '%' . $keyword . '%')
                    ->orWhere('isbn', 'like', '%' . $keyword . '%')
                    ->orWhere('peminatan', 'like', '%' . $keyword . '%')
                    ->orWhere('sub_peminatan', 'like', '%' . $keyword . '%');
            });
        }

        // Filter logic remains the same
        if ($request->has('filter') && $request->filter != 'all') {
            $filter = $request->filter;
            if (in_array($filter, ['judul', 'penulis', 'isbn', 'peminatan', 'sub_peminatan'])) {
                $filterValue = $request->input('filter_value');
                if ($filterValue) {
                    $query->where($filter, 'like', '%' . $filterValue . '%');
                }
            }
        }

        $books = $query->paginate(10)->appends($request->query());
        $peminatans = Book::distinct()->pluck('peminatan');
        $subPeminatans = Book::distinct()->pluck('sub_peminatan');

        return view('public.books.index', compact('books', 'peminatans', 'subPeminatans'));
    }

    public function show($isbn)
    {
        // Ambil detail buku (menggunakan buku pertama sebagai referensi)
        $bookReference = Book::where('isbn', $isbn)->firstOrFail();

        // Hitung stok yang tersedia dan total
        $stockInfo = Book::where('isbn', $isbn)
            ->selectRaw('COUNT(CASE WHEN is_available = true THEN 1 END) as available_stock')
            ->selectRaw('COUNT(*) as total_copies')
            ->first();
        // Load loans jika diperlukan
        $activeLoans = BookLoan::whereIn('kode_unik_buku',
            Book::where('isbn', $isbn)->pluck('id')
        )
            ->whereNull('return_date')
            ->with('user:id,name')
            ->get();

        return view('public.books.show', compact('bookReference', 'stockInfo', 'activeLoans'));
    }

}