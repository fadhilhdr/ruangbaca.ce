<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('admin.studentData.index', compact('students'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.studentData.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nim' => 'required|string|max:15|unique:students,nim',
            'name' => 'required|string|max:255',
            'angkatan' => 'required|integer|min:2000|max:' . date('Y'),
            'gender' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        // Simpan data ke tabel students
        Student::create([
            'nim' => $validated['nim'],
            'name' => $validated['name'],
            'angkatan' => $validated['angkatan'],
            'gender' => $validated['gender'],
            'status' => $validated['status'],
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.students.index')->with('success', 'Data student berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
    public function upload()
    {
        return view('admin.studentData.import');
    }
    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        // Impor data
        Excel::import(new StudentsImport, $request->file('file'));

        // Redirect dengan pesan sukses
        return redirect()->route('admin.students.index')->with('success', 'Data mahasiswa berhasil diimpor.');
    }
}