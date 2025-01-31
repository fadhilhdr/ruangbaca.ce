<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Capstone;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CapstoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Capstone::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('judul_capstone', 'like', "%$search%")
                ->orWhere('kode_kelompok', 'like', "%$search%") // Tambahan pencarian berdasarkan kode kelompok
                ->orWhereHas('anggota1', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('anggota2', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('anggota3', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
        }

        $capstones = $query->get();
        return view('admin.capstoneData.index', compact('capstones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('admin.capstoneData.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kelompok'  => 'required|unique:capstones',
            'anggota1_nim'   => 'required|exists:students,nim',
            'anggota2_nim'   => 'nullable|exists:students,nim',
            'anggota3_nim'   => 'nullable|exists:students,nim',
            'kategori'       => 'required',
            'judul_capstone' => 'required',
            'c100'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'c200'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'c300'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'c400'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'c500'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->except(['c100', 'c200', 'c300', 'c400', 'c500']);

        foreach (['c100', 'c200', 'c300', 'c400', 'c500'] as $file) {
            if ($request->hasFile($file)) {
                $data["{$file}_path"] = $request->file($file)->store('capstone', 'public');
            }
        }

        Capstone::create($data);
        Alert::success('success', 'Dokumen capstone berhasil ditambahkan!');
        return redirect()->route('admin.capstones.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Capstone $capstone)
    {
        $students = Student::all();
        return view('admin.capstoneData.edit', compact('capstone', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $capstone = Capstone::findOrFail($id);

        $request->validate([
            'kode_kelompok'  => "required|unique:capstones,kode_kelompok,$id",
            'anggota1_nim'   => 'required|exists:students,nim',
            'anggota2_nim'   => 'nullable|exists:students,nim',
            'anggota3_nim'   => 'nullable|exists:students,nim',
            'kategori'       => 'required',
            'judul_capstone' => 'required',
            'c100'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'c200'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'c300'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'c400'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'c500'           => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->except(['c100', 'c200', 'c300', 'c400', 'c500']);

        foreach (['c100', 'c200', 'c300', 'c400', 'c500'] as $file) {
            if ($request->hasFile($file)) {
                // Hapus file lama
                if ($capstone["{$file}_path"]) {
                    Storage::disk('public')->delete($capstone["{$file}_path"]);
                }

                // Simpan file baru
                $data["{$file}_path"] = $request->file($file)->store('capstone', 'public');
            }
        }

        $capstone->update($data);
        Alert::success('success', 'Dokumen capstone berhasil diperbaharui!');

        return redirect()->route('admin.capstoneData.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $capstone = Capstone::findOrFail($id);

        foreach (['c100_path', 'c200_path', 'c300_path', 'c400_path', 'c500_path'] as $file) {
            if ($capstone->$file) {
                Storage::disk('public')->delete($capstone->$file);
            }
        }

        $capstone->delete();
        Alert::success('success', 'Dokumen capstone berhasil dihapus!');
        return redirect()->route('admin.capstones.index');
    }
}
