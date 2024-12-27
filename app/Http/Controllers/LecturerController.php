<?php

namespace App\Http\Controllers;

use App\Imports\LecturersImport;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lecturers = Lecturer::paginate(5);
        return view('admin.lecturersData.index', compact('lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lecturersData.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nip' => 'required|string|max:20|unique:lecturers,nip',
            'name' => 'required|string|max:255',
            'kode_dosen' => 'required|string|max:10|unique:lecturers,kode_dosen',
            'riwayat_s1' => 'required|string|max:255',
            'riwayat_s2' => 'required|string|max:255',
            'riwayat_s3' => 'nullable|string|max:255',
            'kepakaran1' => 'required|string|max:255',
            'kepakaran2' => 'nullable|string|max:255',
        ]);

        // Buat dosen baru
        Lecturer::create([
            'nip' => $validated['nip'],
            'name' => $validated['name'],
            'kode_dosen' => $validated['kode_dosen'],
            'riwayat_s1' => $validated['riwayat_s1'],
            'riwayat_s2' => $validated['riwayat_s2'],
            'riwayat_s3' => $validated['riwayat_s3'],
            'kepakaran1' => $validated['kepakaran1'],
            'kepakaran2' => $validated['kepakaran2'],
        ]);

        // Redirect ke halaman daftar dosen dengan pesan sukses
        return redirect()->route('admin.lecturers.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }
    public function upload()
    {
        return view("admin.lecturersData.import");
    }
    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Proses import data dari file Excel
        Excel::import(new LecturersImport, $request->file('file'));

        // Redirect dengan pesan sukses
        return redirect()->route('admin.lecturers.index')->with('success', 'Data dosen berhasil diimport.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Lecturer $lecturer)
    {
        //
    }

    public function edit($nip)
    {
        $lecturer = Lecturer::findOrFail($nip); // Ambil data dosen berdasarkan ID
        return view('admin.lecturersData.edit', compact('lecturer'));
    }
    public function update(Request $request, $nip)
    {
        $request->validate([
            'nip' => 'required|numeric|unique:lecturers,nip,' . $nip,
            'name' => 'required|string|max:255',
            'kode_dosen' => 'required|string|max:50',
            'riwayat_s1' => 'required|string|max:255',
            'riwayat_s2' => 'required|string|max:255',
            'riwayat_s3' => 'nullable|string|max:255',
            'kepakaran1' => 'required|string|max:255',
            'kepakaran2' => 'nullable|string|max:255',
        ]);

        $lecturer = Lecturer::findOrFail($nip);
        $lecturer->update($request->all());

        return redirect()->route('admin.lecturers.index')->with('success', 'Data lecturer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecturer $lecturer)
    {
        //
    }
}