<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\BooksImport;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search'       => 'nullable|string|max:255',
            'peminatan'    => 'nullable|string',
            'is_available' => 'nullable|boolean',
        ]);

        $query = Book::query();

        if (! empty($validated['search'])) {
            $query->where(function ($q) use ($validated) {
                $q->where('judul', 'LIKE', "%{$validated['search']}%")
                    ->orWhere('penulis', 'LIKE', "%{$validated['search']}%")
                    ->orWhere('isbn', 'LIKE', "%{$validated['search']}%");
            });
        }

        if (! empty($validated['peminatan'])) {
            $query->where('peminatan', $validated['peminatan']);
        }

        if (isset($validated['is_available'])) {
            $query->where('is_available', $validated['is_available']);
        }

        $books = $query->paginate(10);
        return view('admin.bookData.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bookData.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'         => 'required|string|max:255',
            'penulis'       => 'required|string|max:255',
            'penerbit'      => 'required|string|max:255',
            'isbn'          => 'required|string|max:255',
            'peminatan'     => 'required|string|max:255',
            'sub_peminatan' => 'nullable|string|max:255',
            'kode_unik'     => 'required|string|max:255|unique:books,kode_unik',
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:2048',
            'synopsis'      => 'nullable|string',
            'is_available'  => 'required|boolean',
        ], [
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Format file harus berupa JPG, JPEG, atau PNG.',
            'thumbnail.max'   => 'Ukuran file maksimal adalah 2 MB.',
        ]);

        if ($request->hasFile('thumbnail')) {
            $file                   = $request->file('thumbnail');
            $fileName               = time() . '_' . $file->getClientOriginalName();
            $filePath               = $file->storeAs('thumbnails', $fileName, 'public');
            $validated['thumbnail'] = $filePath; // Simpan path file ke validated array
        }

        Book::create($validated); // Simpan data termasuk thumbnail path
        Alert::success('success', 'Buku berhasil ditambahkan!');
        return redirect()->route('admin.books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.bookData.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validated = $request->validate([
            'judul'         => 'required|string|max:255',
            'penulis'       => 'required|string|max:255',
            'penerbit'      => 'required|string|max:255',
            'isbn'          => 'required|string|max:255',
            'peminatan'     => 'required|string|max:255',
            'sub_peminatan' => 'nullable|string|max:255',
            'kode_unik'     => "required|string|max:255|unique:books,kode_unik,{$id}",
            'thumbnail'     => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:2048',
            'synopsis'      => 'nullable|string',
            'is_available'  => 'required|boolean',
        ]);

        // Temukan data buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Cek apakah ada file thumbnail baru yang diunggah
        if ($request->hasFile('thumbnail')) {
            // Hapus file thumbnail lama jika ada
            if ($book->thumbnail && Storage::disk('public')->exists($book->thumbnail)) {
                Storage::disk('public')->delete($book->thumbnail);
            }

            // Simpan file thumbnail baru
            $file     = $request->file('thumbnail');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('thumbnails', $fileName, 'public');

            // Tambahkan path thumbnail ke data yang divalidasi
            $validated['thumbnail'] = $filePath;
        }

        // Update data buku
        $book->update($validated);
        Alert::success('success', 'Buku berhasil diperbarui!');
        return redirect()->route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        Alert::success('success', 'Buku berhasil dihapus!');
        return redirect()->route('admin.books.index');
    }

    /**
     * Import books from an Excel file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        Excel::import(new BooksImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data buku berhasil diimpor!');
    }
    public function downloadTemplate()
    {
        $filePath = 'public/templates/book_template.xlsx';
        return Storage::download($filePath);
    }
}
