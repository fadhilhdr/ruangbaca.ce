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
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('nim', 'LIKE', "%{$search}%");
        }

        $students = $query->paginate(10);
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
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.studentData.edit', compact('student'));
    }

/**
 * Update the specified resource in storage.
 */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:students,nim,' . $id,
            'name' => 'required|string|max:255',
            'angkatan' => 'required|numeric',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('admin.students.index')->with('success', 'Data student berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim)
    {
        $student = Student::where('nim', $nim)->firstOrFail();
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
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