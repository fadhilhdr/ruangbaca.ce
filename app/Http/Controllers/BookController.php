<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Specialization;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan daftar buku (public)
    public function index(Request $request)
    {
        $query = Book::query()->with('specialization'); // Eager loading

        // Pencarian berdasarkan kata kunci tunggal
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('author', 'like', '%' . $keyword . '%')
                ->orWhere('isbn', 'like', '%' . $keyword . '%');
            });
        }

        // Filter lanjutan berdasarkan kolom tertentu
        if ($request->has('filter') && $request->filter != 'all') {
            $filter = $request->filter;
            if (in_array($filter, ['title', 'author', 'isbn', 'specialization_id'])) {
                $query->where($filter, 'like', '%' . $request->input('keyword') . '%');
            }
        }

        $books = $query->paginate(10); // Ambil data buku dengan pagination
        $specializations = Specialization::all(); // Ambil data spesialisasi

        return view('public.books.index', compact('books', 'specializations'));
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('public.books.show', compact('book'));
    }
}
