<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan daftar buku (public)
    public function index(Request $request)
    {
        // Pencarian buku berdasarkan judul, pengarang, atau spesialisasi
        $query = Book::query();

        // Filter berdasarkan judul
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        // Filter berdasarkan pengarang
        if ($request->has('author')) {
            $query->where('author', 'like', '%' . $request->input('author') . '%');
        }

        // Filter berdasarkan spesialisasi
        if ($request->has('specialization_id')) {
            $query->where('specialization_id', $request->input('specialization_id'));
        }

        // Ambil data buku dengan pagination
        $books = $query->paginate(10);

        return view('public.books.index', compact('books'));
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('public.books.show', compact('book'));
    }
}
