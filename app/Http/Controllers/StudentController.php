<?php
namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
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
        return redirect()->route('admin.students.index');
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
    public function edit($nim)
    {
        $student = Student::findOrFail($nim);
        return view('admin.studentData.edit', compact('student'));
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
        return redirect()->route('admin.students.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nim)
    {
        $student = Student::where('nim', $nim)->firstOrFail();
        $student->delete();

        Alert::success('Berhasil!', 'Data mahasiswa berhasil dihapus!.');

        return redirect()->route('admin.students.index');
    }

    public function import(Request $request)
    {
        // Validate file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ], [
            'file.required' => 'File wajib diunggah',
            'file.mimes'    => 'Format file harus xls, xlsx',
            'file.max'      => 'Ukuran file maksimal 2MB',
        ]);

        try {
            // Read Excel file for validation
            $array  = Excel::toArray(new StudentsImport, $request->file('file'));
            $errors = [];

            // Validate each row
            foreach ($array[0] as $rowIndex => $row) {

                // Skip header row and empty rows
                if ($rowIndex === 0 || empty(array_filter($row))) {
                    continue;
                }

                $rowNum = $rowIndex + 1;

                // NIM validation
                if (empty($row[0])) {
                    $errors[] = "Baris {$rowNum}: NIM tidak boleh kosong";
                } elseif (Student::where('nim', $row[0])->exists()) {
                    $errors[] = "Baris {$rowNum}: NIM '{$row[0]}' sudah terdaftar";
                }

                // Name validation
                if (empty($row[1])) {
                    $errors[] = "Baris {$rowNum}: Nama tidak boleh kosong";
                } elseif (Student::where('name', $row[1])->exists()) {
                    $errors[] = "Baris {$rowNum}: Nama '{$row[1]}' sudah terdaftar";
                }

                // Angkatan validation
                if (empty($row[2])) {
                    $errors[] = "Baris {$rowNum}: Angkatan tidak boleh kosong";
                } elseif (! is_numeric($row[2]) || strlen($row[2]) !== 4) {
                    $errors[] = "Baris {$rowNum}: Angkatan harus berupa 4 digit angka";
                }

                // Gender validation
                if (empty($row[3])) {
                    $errors[] = "Baris {$rowNum}: Jenis Kelamin tidak boleh kosong";
                } elseif (! in_array($row[3], ['Laki-laki', 'Perempuan'])) {
                    $errors[] = "Baris {$rowNum}: Jenis Kelamin harus 'Laki-laki' atau 'Perempuan'";
                }

                // Status validation
                if (empty($row[4])) {
                    $errors[] = "Baris {$rowNum}: Status tidak boleh kosong";
                }

                // Prodi validation
                if (empty($row[5])) {
                    $errors[] = "Baris {$rowNum}: Program Studi tidak boleh kosong";
                }

                // Jalur Masuk validation
                if (empty($row[6])) {
                    $errors[] = "Baris {$rowNum}: Jalur Masuk tidak boleh kosong";
                }

            }

            if (! empty($errors)) {
                Alert::error('Error', implode('<br>', $errors));
                return redirect()->route('admin.students.create');
            }

            // If validation passes, import the data
            Excel::import(new StudentsImport, $request->file('file'));
            Alert::success('Berhasil!', 'Data mahasiswa berhasil diunggah!');
            return redirect()->route('admin.students.index');

        } catch (\Exception $e) {
            Alert::error('Error', 'Terdapat kesalahan pada struktur file! Pastikan format file sesuai template dan jangan sampai data kosong!.');
            return redirect()->route('admin.students.create');
        }
    }
    public function downloadTemplate()
    {
        $filePath = 'public/templates/student_template.xlsx';

        return Storage::download($filePath);

    }

}