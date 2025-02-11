<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Capstone;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        return view('admin.capstoneData.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'kode_kelompok'  => [
                    'required',
                    'string',
                    'unique:capstones,kode_kelompok',
                ],
                'anggota1_nim'   => 'required|string|exists:students,nim',
                'anggota2_nim'   => 'nullable|string|exists:students,nim|different:anggota1_nim',
                'anggota3_nim'   => 'nullable|string|exists:students,nim|different:anggota1_nim,anggota2_nim',
                'kategori'       => 'required|string',
                'judul_capstone' => 'required|string|max:255',
                'c100_path'      => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'c200_path'      => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'c300_path'      => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'c400_path'      => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'c500_path'      => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            ]);

            // Check for duplicate team members
            $nims = array_filter([
                $request->anggota1_nim,
                $request->anggota2_nim,
                $request->anggota3_nim,
            ]);

            $existingMembers = Capstone::where(function ($query) use ($nims) {
                foreach ($nims as $nim) {
                    $query->orWhere('anggota1_nim', $nim)
                        ->orWhere('anggota2_nim', $nim)
                        ->orWhere('anggota3_nim', $nim);
                }
            })->first();

            if ($existingMembers) {
                $duplicateNim = collect($nims)->first(function ($nim) use ($existingMembers) {
                    return $existingMembers->anggota1_nim === $nim
                    || $existingMembers->anggota2_nim === $nim
                    || $existingMembers->anggota3_nim === $nim;
                });

                throw new \Exception("NIM {$duplicateNim} sudah tergabung dalam kelompok lain.");
            }

            // Prepare data for storage
            $data       = $request->except(['c100_path', 'c200_path', 'c300_path', 'c400_path', 'c500_path']);
            $folderPath = 'capstone-documents/' . $request->kode_kelompok;

            // Handle file uploads
            foreach (['c100', 'c200', 'c300', 'c400', 'c500'] as $file) {
                $pathKey = "{$file}_path";
                if ($request->hasFile($pathKey)) {
                    $extension = $request->file($pathKey)->getClientOriginalExtension();
                    $filename  = "{$file}_" . time() . ".{$extension}";

                    $path = $request->file($pathKey)->storeAs(
                        "public/{$folderPath}",
                        $filename
                    );

                    if (! $path) {
                        throw new \Exception("Gagal mengunggah file {$file}");
                    }

                    $data[$pathKey] = str_replace('public/', '', $path);
                }
            }

            // Create capstone record
            DB::beginTransaction();
            try {
                Capstone::create($data);
                DB::commit();
                Alert::success('Success', 'Dokumen capstone berhasil ditambahkan!');
                return redirect()->route('admin.capstones.index');
            } catch (\Exception $e) {
                DB::rollBack();
                // Clean up uploaded files if database transaction fails
                if (isset($data)) {
                    foreach (['c100_path', 'c200_path', 'c300_path', 'c400_path', 'c500_path'] as $pathKey) {
                        if (isset($data[$pathKey])) {
                            Storage::delete('public/' . $data[$pathKey]);
                        }
                    }
                }
                throw $e;
            }
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return back()->withInput();
        }
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
        try {
            $capstone = Capstone::findOrFail($id);

            // Validate the request
            $validated = $request->validate([
                'kode_kelompok'  => [
                    'required',
                    'string',
                    "unique:capstones,kode_kelompok,{$id}",
                ],
                'anggota1_nim'   => 'required|string|exists:students,nim',
                'anggota2_nim'   => 'nullable|string|exists:students,nim|different:anggota1_nim',
                'anggota3_nim'   => 'nullable|string|exists:students,nim|different:anggota1_nim,anggota2_nim',
                'kategori'       => 'required|string',
                'judul_capstone' => 'required|string|max:255',
                'c100'           => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'c200'           => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'c300'           => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'c400'           => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'c500'           => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            ]);

            // Check for duplicate team members (excluding current team)
            $nims = array_filter([
                $request->anggota1_nim,
                $request->anggota2_nim,
                $request->anggota3_nim,
            ]);

            $existingMembers = Capstone::where('id', '!=', $id)
                ->where(function ($query) use ($nims) {
                    foreach ($nims as $nim) {
                        $query->orWhere('anggota1_nim', $nim)
                            ->orWhere('anggota2_nim', $nim)
                            ->orWhere('anggota3_nim', $nim);
                    }
                })->first();

            if ($existingMembers) {
                $duplicateNim = collect($nims)->first(function ($nim) use ($existingMembers) {
                    return $existingMembers->anggota1_nim === $nim
                    || $existingMembers->anggota2_nim === $nim
                    || $existingMembers->anggota3_nim === $nim;
                });

                throw new \Exception("NIM {$duplicateNim} sudah tergabung dalam kelompok lain.");
            }

            // Prepare data for update
            $data       = $request->except(['c100', 'c200', 'c300', 'c400', 'c500']);
            $folderPath = 'capstone-documents/' . $request->kode_kelompok;

            // Begin transaction for file and database operations
            DB::beginTransaction();
            try {
                // Handle file uploads
                foreach (['c100', 'c200', 'c300', 'c400', 'c500'] as $file) {
                    if ($request->hasFile($file)) {
                        $extension = $request->file($file)->getClientOriginalExtension();
                        $filename  = "{$file}_" . time() . ".{$extension}";
                        $pathKey   = "{$file}_path";

                        // Delete old file if exists
                        if ($capstone->$pathKey) {
                            Storage::delete('public/' . $capstone->$pathKey);
                        }

                        // Store new file
                        $path = $request->file($file)->storeAs(
                            "public/{$folderPath}",
                            $filename
                        );

                        if (! $path) {
                            throw new \Exception("Gagal mengunggah file {$file}");
                        }

                        $data[$pathKey] = str_replace('public/', '', $path);
                    }
                }

                // Update capstone record
                $capstone->update($data);
                DB::commit();

                Alert::success('Success', 'Dokumen capstone berhasil diperbaharui!');
                return redirect()->route('admin.capstones.index');

            } catch (\Exception $e) {
                DB::rollBack();
                // Clean up any newly uploaded files if transaction fails
                if (isset($data)) {
                    foreach (['c100_path', 'c200_path', 'c300_path', 'c400_path', 'c500_path'] as $pathKey) {
                        if (isset($data[$pathKey]) && $data[$pathKey] !== $capstone->$pathKey) {
                            Storage::delete('public/' . $data[$pathKey]);
                        }
                    }
                }
                throw $e;
            }

        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return back()->withInput();
        }
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