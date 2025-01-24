<?php
namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
        return view('superadmin.studentData.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('superadmin.studentData.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nim'             => 'required|string|max:15|unique:students,nim',
            'name'            => 'required|string|max:255',
            'angkatan'        => 'required|integer|min:2000|max:' . date('Y'),
            'gender'          => 'required|in:Laki-laki,Perempuan',
            'status_terakhir' => 'required|in:Aktif,Tidak Aktif',
            'jalur_masuk'     => 'required|string|max:255',
            'prodi'           => 'required|string|max:255',
        ]);

        // Simpan data ke tabel students
        Student::create([
            'nim'             => $validated['nim'],
            'name'            => $validated['name'],
            'angkatan'        => $validated['angkatan'],
            'gender'          => $validated['gender'],
            'status_terakhir' => $validated['status_terakhir'],
            'jalur_masuk'     => $validated['jalur_masuk'],
            'prodi'           => $validated['prodi'],
        ]);

        // Redirect ke halaman index dengan pesan sukses
        Alert::success('Berhasil!', 'Data mahasiswa berhasil ditambahkan!');
        return redirect()->route('superadmin.students.index');
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
    public function edit($nim)
    {
        $student = Student::findOrFail($nim);
        return view('superadmin.studentData.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nim)
    {
        // Validasi data
        $request->validate([
            'nim'             => 'required|numeric|unique:students,nim,' . $nim . ',nim',
            'name'            => 'required|string|max:255',
            'angkatan'        => 'required|numeric',
            'gender'          => 'required|in:Laki-laki,Perempuan',
            'status_terakhir' => 'required|in:Aktif,Tidak Aktif',
            'jalur_masuk'     => 'required|string|max:255',
            'prodi'           => 'required|string|max:255',
        ]);

        // Cari data student berdasarkan NIM
        $student = Student::findOrFail($nim);

        // Perbarui data student
        $student->update([
            'nim'             => $request->nim,
            'name'            => $request->name,
            'angkatan'        => $request->angkatan,
            'gender'          => $request->gender,
            'status_terakhir' => $request->status_terakhir,
            'jalur_masuk'     => $request->jalur_masuk,
            'prodi'           => $request->prodi,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        Alert::success('Berhasil!', 'Data mahasiswa berhasil diperbaharui!.');
        return redirect()->route('superadmin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim)
    {
        $student = Student::where('nim', $nim)->firstOrFail();
        $student->delete();

        Alert::success('Berhasil!', 'Data mahasiswa berhasil dihapus!.');

        return redirect()->route('superadmin.students.index');
    }
}