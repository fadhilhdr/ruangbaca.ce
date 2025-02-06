<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tugasakhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DokumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tugasakhir::with('user');

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('title', 'LIKE', "%{$searchTerm}%")
                ->orWhereHas('user', function ($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('userid', 'LIKE', "%{$searchTerm}%");
                });
        }

        $dokumens = $query->paginate(10);

        return view('admin.dokumen.index', compact('dokumens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim'                 => 'required|string|max:20',
            'judul'               => 'required|string|max:255',
            'cover_abstrak'       => 'required|file|mimes:pdf|max:2048',
            'bab1_pendahuluan'    => 'required|file|mimes:pdf|max:2048',
            'bab2_kajian_pustaka' => 'required|file|mimes:pdf|max:2048',
            'bab3_metodologi'     => 'required|file|mimes:pdf|max:2048',
            'bab4_implementasi'   => 'required|file|mimes:pdf|max:2048',
            'bab5_kesimpulan'     => 'required|file|mimes:pdf|max:2048',
            'lampiran'            => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->except('_token');
        foreach ($request->allFiles() as $key => $file) {
            $data[$key] = $file->store('dokumen_ta');
        }

        TugasAkhir::create($data);
        Alert::success('success', 'Dokumen berhasil ditambahkan!');
        return redirect()->route('admin.dokumen.index');
    }

    public function edit($id)
    {
        $dokumen = TugasAkhir::findOrFail($id);
        return view('admin.dokumen.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = TugasAkhir::findOrFail($id);

        $request->validate([
            'nim'                 => 'required|string|max:20',
            'judul'               => 'required|string|max:255',
            'cover_abstrak'       => 'nullable|file|mimes:pdf|max:2048',
            'bab1_pendahuluan'    => 'nullable|file|mimes:pdf|max:2048',
            'bab2_kajian_pustaka' => 'nullable|file|mimes:pdf|max:2048',
            'bab3_metodologi'     => 'nullable|file|mimes:pdf|max:2048',
            'bab4_implementasi'   => 'nullable|file|mimes:pdf|max:2048',
            'bab5_kesimpulan'     => 'nullable|file|mimes:pdf|max:2048',
            'lampiran'            => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->except('_token', '_method');
        foreach ($request->allFiles() as $key => $file) {
            Storage::delete($dokumen->$key);
            $data[$key] = $file->store('dokumen_ta');
        }

        $dokumen->update($data);
        Alert::success('success', 'Dokumen berhasil diperbarui!');
        return redirect()->route('admin.dokumen.index');
    }

    public function destroy($id)
    {
        $dokumen = TugasAkhir::findOrFail($id);
        foreach (['cover_abstrak', 'bab1_pendahuluan', 'bab2_kajian_pustaka', 'bab3_metodologi', 'bab4_implementasi', 'bab5_kesimpulan', 'lampiran'] as $fileColumn) {
            Storage::delete($dokumen->$fileColumn);
        }

        $dokumen->delete();
        Alert::success('success', 'Dokumen berhasil dihapus!');
        return redirect()->route('admin.dokumen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

}
