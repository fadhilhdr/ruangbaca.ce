<?php

namespace App\Http\Controllers;

use App\Models\Tugasakhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasakhirController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $tugasakhirs = Tugasakhir::when($keyword, function($query) use ($keyword) {
            return $query->search($keyword);
        });

        $tugasakhirs = $tugasakhirs->paginate(10);
        return view('public.tugasakhirs.index', compact('tugasakhirs'));
    }


    public function memberIndex()
    {
        $tugasakhirs = Tugasakhir::where('nim', auth()->user()->userid)->get();
        return view('member.tugasakhirs.index', compact('tugasakhirs'));
    }

    public function show($id)
    {
        $tugasakhir = Tugasakhir::findOrFail($id);
        return view('public.tugasakhirs.show', compact('tugasakhir'));
    }

    public function memberShow($id)
    {
        $tugasakhir = Tugasakhir::findOrFail($id);
        if ($tugasakhir->nim !== auth()->user()->userid) {
            abort(403);
        }
        return view('member.tugasakhirs.show', compact('tugasakhir'));
    }

    public function create()
    {
        return view('member.tugasakhirs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'full_document' => 'required|mimes:pdf|max:51200',
            'cover_abstract' => 'required|mimes:pdf|max:10240',
            'bab1_pendahuluan' => 'required|mimes:pdf|max:15360',
            'bab2_kajianpustaka' => 'required|mimes:pdf|max:15360',
            'bab3_perancangan' => 'required|mimes:pdf|max:15360',
            'bab4_hasilpembahasan' => 'required|mimes:pdf|max:20480',
            'bab5_penutup' => 'required|mimes:pdf|max:10240',
            'lampiran' => 'required|mimes:pdf|max:30720',
        ]);

        $data = $request->all();
        $data['nim'] = auth()->user()->userid;

        // Store files
        $fileFields = [
            'full_document', 'cover_abstract', 'bab1_pendahuluan',
            'bab2_kajianpustaka', 'bab3_perancangan', 'bab4_hasilpembahasan',
            'bab5_penutup', 'lampiran'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('tugasakhirs', 'public');
            }
        }

        Tugasakhir::create($data);

        return redirect()->route('member.tugasakhirs.index')
            ->with('success', 'Tugas Akhir berhasil diunggah.');
    }

    public function edit($id)
    {
        $tugasakhir = Tugasakhir::findOrFail($id);
        if ($tugasakhir->nim !== auth()->user()->userid) {
            abort(403);
        }
        return view('member.tugasakhirs.edit', compact('tugasakhir'));
    }

    public function update(Request $request, $id)
    {
        $tugasakhir = Tugasakhir::findOrFail($id);
        if ($tugasakhir->nim !== auth()->user()->userid) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'full_document' => 'nullable|mimes:pdf|max:10240',
            'cover_abstract' => 'nullable|mimes:pdf|max:10240',
            'bab1_pendahuluan' => 'nullable|mimes:pdf|max:10240',
            'bab2_kajianpustaka' => 'nullable|mimes:pdf|max:10240',
            'bab3_perancangan' => 'nullable|mimes:pdf|max:10240',
            'bab4_hasilpembahasan' => 'nullable|mimes:pdf|max:10240',
            'bab5_penutup' => 'nullable|mimes:pdf|max:10240',
            'lampiran' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data = $request->only(['title']);

        $fileFields = [
            'full_document', 'cover_abstract', 'bab1_pendahuluan',
            'bab2_kajianpustaka', 'bab3_perancangan', 'bab4_hasilpembahasan',
            'bab5_penutup', 'lampiran'
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file
                if ($tugasakhir->$field) {
                    Storage::disk('public')->delete($tugasakhir->$field);
                }
                // Store new file
                $data[$field] = $request->file($field)->store('tugasakhirs', 'public');
            }
        }

        $tugasakhir->update($data);

        return redirect()->route('member.tugasakhirs.show', $tugasakhir->id)
            ->with('success', 'Tugas Akhir berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tugasakhir = Tugasakhir::findOrFail($id);
        if ($tugasakhir->nim !== auth()->user()->userid) {
            abort(403);
        }

        // Delete all files
        $fileFields = [
            'full_document', 'cover_abstract', 'bab1_pendahuluan',
            'bab2_kajianpustaka', 'bab3_perancangan', 'bab4_hasilpembahasan',
            'bab5_penutup', 'lampiran'
        ];

        foreach ($fileFields as $field) {
            if ($tugasakhir->$field) {
                Storage::disk('public')->delete($tugasakhir->$field);
            }
        }

        $tugasakhir->delete();

        return redirect()->route('member.tugasakhirs.index')
            ->with('success', 'Tugas Akhir berhasil dihapus.');
    }
}