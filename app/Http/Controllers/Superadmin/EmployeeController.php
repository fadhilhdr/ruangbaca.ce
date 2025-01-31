<?php
namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Pegawai::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                    ->orWhere('nip_nppu_nupk', 'LIKE', "%{$search}%");
            });
        }

        $pegawais = $query->paginate(5);
        return view('superadmin.lecturersData.index', compact('pegawais'));
    }

    public function create()
    {
        return view('superadmin.lecturersData.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap'        => 'required|string|max:255',
            'nip_nppu_nupk'       => 'required|string|unique:pegawais,nip_nppu_nupk',
            'nidn_nidk_nup_nitk'  => 'nullable|string',
            'nuptk'               => 'nullable|string',
            'pangkat_golongan'    => 'nullable|string',
            'jabatan_fungsional'  => 'nullable|string',
            'tugas_tambahan_1'    => 'nullable|string',
            'tugas_tambahan_2'    => 'nullable|string',
            'tugas_tambahan_3'    => 'nullable|string',
            'tugas_tambahan_4'    => 'nullable|string',
            'kepakaran'           => 'nullable|string',
            'pendidikan_terakhir' => 'nullable|string',
            'jurusan'             => 'nullable|string',
            'status_bekerja'      => 'nullable|in:Aktif,Non-Aktif',
            'status_kepegawaian'  => 'nullable|string',
            'jenis_pegawai'       => 'required|in:Tenaga Dosen,Tenaga Kependidikan',
            'unit_kerja'          => 'nullable|string',
            'bagian'              => 'nullable|string',
            'subbagian'           => 'nullable|string',
        ]);

        try {
            $pegawai = Pegawai::create($validatedData);

            Alert::success('Berhasil!', 'Data Pegawai berhasil ditambahkan.!.');

            return redirect()->route('superadmin.employees.index');

        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Gagal menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('superadmin.lecturersData.edit', compact('pegawai'));
    }

    public function update(Request $request, $nip_nppu_nupk)
    {
        $pegawai = Pegawai::findOrFail($nip_nppu_nupk);

        $validatedData = $request->validate([
            'nama_lengkap'        => 'required|string|max:255',
            'nip_nppu_nupk'       => 'required|string|unique:pegawais,nip_nppu_nupk,' . $pegawai->nip_nppu_nupk . ',nip_nppu_nupk',
            'nidn_nidk_nup_nitk'  => 'nullable|string',
            'nuptk'               => 'nullable|string',
            'pangkat_golongan'    => 'nullable|string',
            'jabatan_fungsional'  => 'nullable|string',
            'tugas_tambahan_1'    => 'nullable|string',
            'tugas_tambahan_2'    => 'nullable|string',
            'tugas_tambahan_3'    => 'nullable|string',
            'tugas_tambahan_4'    => 'nullable|string',
            'kepakaran'           => 'nullable|string',
            'pendidikan_terakhir' => 'nullable|string',
            'jurusan'             => 'nullable|string',
            'status_bekerja'      => 'nullable|in:Aktif,Non-Aktif',
            'status_kepegawaian'  => 'nullable|string',
            'jenis_pegawai'       => 'required|in:Tenaga Dosen,Tenaga Kependidikan',
            'unit_kerja'          => 'nullable|string',
            'bagian'              => 'nullable|string',
            'subbagian'           => 'nullable|string',
        ]);

        try {
            $pegawai->update($validatedData);

            Alert::success('Berhasil!', 'Data Pegawai berhasil diperbaharui.!.');

            return redirect()->route('superadmin.employees.index');

        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Gagal memperbarui data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->delete();

            Alert::success('Berhasil!', 'Data Pegawai berhasil dihapus!.');

            return redirect()->route('superadmin.employees.index');

        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }
}