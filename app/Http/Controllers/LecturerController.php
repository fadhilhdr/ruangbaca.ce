<?php
namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lecturer::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('nip', 'LIKE', "%{$search}%");
        }

        $lecturers = $query->paginate(10);
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
            'nip'        => 'required|string|max:20|unique:lecturers,nip',
            'name'       => 'required|string|max:255',
            'kode_dosen' => 'required|string|max:10|unique:lecturers,kode_dosen',
            'riwayat_s1' => 'required|string|max:255',
            'riwayat_s2' => 'required|string|max:255',
            'riwayat_s3' => 'nullable|string|max:255',
            'kepakaran1' => 'required|string|max:255',
            'kepakaran2' => 'nullable|string|max:255',
        ]);

        // Buat dosen baru
        Lecturer::create([
            'nip'        => $validated['nip'],
            'name'       => $validated['name'],
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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        // Membaca file Excel
        $path = $request->file('file')->getRealPath();
        $data = Excel::toArray([], $path);

        // Ambil sheet pertama
        $sheet = $data[0];

        // Validasi duplikasi di file Excel
        $nipList       = [];
        $kodeDosenList = [];
        $errors        = [];

        foreach ($sheet as $index => $row) {
            if ($index === 0) {
                continue; // Lewati header baris pertama
            }

            $nip        = $row[0];
            $name       = $row[1];
            $kodeDosen  = $row[2];
            $riwayatS1  = $row[3];
            $riwayatS2  = $row[4];
            $riwayatS3  = $row[5];
            $kepakaran1 = $row[6];
            $kepakaran2 = $row[7];

            // Cek duplikat di dalam Excel
            if (in_array($nip, $nipList)) {
                $errors[] = "Baris " . ($index + 1) . ": NIP '$nip' duplikat di file Excel.";
            } else {
                $nipList[] = $nip;
            }

            if (in_array($kodeDosen, $kodeDosenList)) {
                $errors[] = "Baris " . ($index + 1) . ": Kode dosen '$kodeDosen' duplikat di file Excel.";
            } else {
                $kodeDosenList[] = $kodeDosen;
            }

            // Cek duplikat di database
            if (Lecturer::where('nip', $nip)->exists()) {
                $errors[] = "Baris " . ($index + 1) . ": NIP '$nip' sudah ada di database.";
            }

            if (Lecturer::where('kode_dosen', $kodeDosen)->exists()) {
                $errors[] = "Baris " . ($index + 1) . ": Kode dosen '$kodeDosen' sudah ada di database.";
            }

            // Validasi data yang diperlukan
            if (empty($riwayatS1) || empty($riwayatS2) || empty($kepakaran1)) {
                $errors[] = "Baris " . ($index + 1) . ": Riwayat S1, Riwayat S2, dan Kepakaran 1 wajib diisi.";
            }
        }

        // Jika ada error, kembali dengan pesan
        if (! empty($errors)) {
            return redirect()->back()->withErrors(['upload' => $errors]);
        }

        // Simpan data ke database
        foreach ($sheet as $index => $row) {
            if ($index === 0) {
                continue; // Lewati header baris pertama
            }

            Lecturer::create([
                'nip'        => $row[0],
                'name'       => $row[1],
                'kode_dosen' => $row[2],
                'riwayat_s1' => $row[3],
                'riwayat_s2' => $row[4],
                'riwayat_s3' => $row[5],
                'kepakaran1' => $row[6],
                'kepakaran2' => $row[7],
            ]);
        }
        return redirect()->route('admin.lecturers.index')->with('success', 'Data dosen berhasil diunggah.');
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
            'nip'        => 'required|numeric|unique:lecturers,nip,' . $nip,
            'name'       => 'required|string|max:255',
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