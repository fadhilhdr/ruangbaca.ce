<?php

namespace App\Http\Controllers;

use App\Models\Capstone;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CapstoneController extends Controller
{
    public function index(Request $request)
    {
        // Base query with relationships for team members
        $query = Capstone::with([
            'anggota1:nim,name',
            'anggota2:nim,name',
            'anggota3:nim,name'
        ]);
        
        // Search logic
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('judul_capstone', 'like', '%' . $keyword . '%')
                    ->orWhere('kode_kelompok', 'like', '%' . $keyword . '%')
                    ->orWhere('kategori', 'like', '%' . $keyword . '%')
                    ->orWhereHas('anggota1', function($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('nim', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('anggota2', function($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('nim', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('anggota3', function($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('nim', 'like', '%' . $keyword . '%');
                    });
            });
        }
        
        // Filter logic
        if ($request->has('filter') && $request->filter != '') {
            $filter = $request->filter;
            $filterValue = $request->input('filter_value');
            
            if ($filterValue) {
                switch ($filter) {
                    case 'judul_capstone':
                        $query->where('judul_capstone', 'like', '%' . $filterValue . '%');
                        break;
                    case 'kode_kelompok':
                        $query->where('kode_kelompok', 'like', '%' . $filterValue . '%');
                        break;
                    case 'kategori':
                        $query->where('kategori', 'like', '%' . $filterValue . '%');
                        break;
                    case 'anggota':
                        $query->where(function($q) use ($filterValue) {
                            $q->whereHas('anggota1', function($q) use ($filterValue) {
                                $q->where('name', 'like', '%' . $filterValue . '%')
                                    ->orWhere('nim', 'like', '%' . $filterValue . '%');
                            })
                            ->orWhereHas('anggota2', function($q) use ($filterValue) {
                                $q->where('name', 'like', '%' . $filterValue . '%')
                                    ->orWhere('nim', 'like', '%' . $filterValue . '%');
                            })
                            ->orWhereHas('anggota3', function($q) use ($filterValue) {
                                $q->where('name', 'like', '%' . $filterValue . '%')
                                    ->orWhere('nim', 'like', '%' . $filterValue . '%');
                            });
                        });
                        break;
                }
            }
        }
        
        // Sort logic
        $sortField = $request->input('sort', 'created_at'); // default sort by created_at
        $sortDirection = $request->input('direction', 'desc'); // default direction is descending
        
        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['kode_kelompok', 'judul_capstone', 'kategori', 'created_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        
        // Validate sort direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }
        
        $query->orderBy($sortField, $sortDirection);
        
        // Get paginated results
        $capstones = $query->paginate(10)
                           ->appends($request->query());
        
        // Get unique categories for filter dropdown
        $categories = Capstone::distinct()->pluck('kategori');
        
        // Pass all necessary data to the view
        return view('public.capstones.index', compact(
            'capstones',
            'categories',
            'sortField',
            'sortDirection'
        ));
    }

    public function memberIndex()
    {
        // Get authenticated user's NIM
        $userNim = auth()->user()->userid;
        
        // Get capstones where user is a member
        $capstones = Capstone::where('anggota1_nim', $userNim)
            ->orWhere('anggota2_nim', $userNim)
            ->orWhere('anggota3_nim', $userNim)
            ->paginate(10);
            
        return view('member.capstones.index', compact('capstones'));
    }

    public function create()
    {
        // Check if user already has a capstone
        $userNim = auth()->user()->userid;
        $hasCapstone = Capstone::where(function($query) use ($userNim) {
            $query->where('anggota1_nim', $userNim)
                  ->orWhere('anggota2_nim', $userNim)
                  ->orWhere('anggota3_nim', $userNim);
        })->exists();
    
        if ($hasCapstone) {
            return redirect()->route('member.capstones.index')
                ->with('error', 'Anda sudah memiliki project capstone aktif.');
        }
        
        return view('member.capstones.create');
    }

    public function checkNim($nim)
    {
        $student = Student::where('nim', $nim)->first();
        
        if (!$student) {
            return response()->json([
                'exists' => false,
                'inTeam' => false
            ]);
        }

        $inTeam = Capstone::where('anggota1_nim', $nim)
            ->orWhere('anggota2_nim', $nim)
            ->orWhere('anggota3_nim', $nim)
            ->exists();

        return response()->json([
            'exists' => true,
            'inTeam' => $inTeam
        ]);
    }
    
    public function checkKode($kode)
    {
        return response()->json([
            'exists' => Capstone::where('kode_kelompok', $kode)->exists()
        ]);
    }

    public function store(Request $request)
    {
        // Check if authenticated user already has a capstone
        $userNim = auth()->user()->userid;
        $hasCapstone = Capstone::where(function($query) use ($userNim) {
            $query->where('anggota1_nim', $userNim)
                  ->orWhere('anggota2_nim', $userNim)
                  ->orWhere('anggota3_nim', $userNim);
        })->exists();
    
        if ($hasCapstone) {
            return redirect()->route('member.capstones.index')
                ->with('error', 'Anda sudah memiliki project capstone aktif.');
        }
        
        $validated = $request->validate([
            'kode_kelompok' => [
                'required',
                'unique:capstones',
                'regex:/^S[1-2]T\d{2}K\d{2}$/'
            ],
            'judul_capstone' => 'required',
            'kategori' => 'required',
            'anggota2_nim' => 'nullable|exists:students,nim',
            'anggota3_nim' => 'nullable|exists:students,nim',
            'c100' => 'nullable|file|mimes:pdf|max:2048',
            'c200' => 'nullable|file|mimes:pdf|max:2048',
            'c300' => 'nullable|file|mimes:pdf|max:2048',
            'c400' => 'nullable|file|mimes:pdf|max:2048',
            'c500' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        // Cek apakah anggota sudah terlibat di capstone lain
        foreach (['anggota2_nim', 'anggota3_nim'] as $field) {
            if ($request->filled($field)) {
                $isAlreadyInTeam = Capstone::where('anggota1_nim', $request->$field)
                    ->orWhere('anggota2_nim', $request->$field)
                    ->orWhere('anggota3_nim', $request->$field)
                    ->exists();
    
                if ($isAlreadyInTeam) {
                    return back()
                        ->withInput()
                        ->withErrors(["$field" => "NIM {$request->$field} sudah terlibat di capstone tim lain."]);
                }
            }
        }

        $data = $validated;
        $data['anggota1_nim'] = auth()->user()->userid;
    
        // Create folder if not exists
        $folderPath = 'capstone-documents/' . $request->kode_kelompok;
        Storage::makeDirectory('public/' . $folderPath);

        // Handle file uploads
        foreach(['c100', 'c200', 'c300', 'c400', 'c500'] as $doc) {
            if ($request->hasFile($doc)) {
                $file = $request->file($doc);
                $filename = $doc . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/' . $folderPath, $filename);
                $data[$doc.'_path'] = $folderPath . '/' . $filename;
            }
        }

        Capstone::create($data);
    
        return redirect()->route('member.capstones.index')
            ->with('success', 'Capstone berhasil dibuat!');
    }

    public function show($id)
    {
        $capstone = Capstone::with([
            'anggota1:nim,name', 
            'anggota2:nim,name', 
            'anggota3:nim,name'
        ])->findOrFail($id);
    
        $documents = [
            'c100_path' => 'Dokumen C100',
            'c200_path' => 'Dokumen C200',
            'c300_path' => 'Dokumen C300',
            'c400_path' => 'Dokumen C400',
            'c500_path' => 'Dokumen C500'
        ];
    
        // If user is not authenticated, hide restricted data
        if (!auth()->check()) {
            $capstone->makeHidden([
                'c200_path',
                'c300_path',
                'c400_path',
                'c500_path',
            ]);
        }
    
        return view('public.capstones.show', [
            'capstone' => $capstone,
            'documents' => $documents
        ]);
    }


    public function memberShow($id)
    {
        $capstone = Capstone::findOrFail($id);

        if ($capstone->anggota1_nim !== auth()->user()->userid &&
            $capstone->anggota2_nim !== auth()->user()->userid &&
            $capstone->anggota3_nim !== auth()->user()->userid
        ) {
            abort(403);
        }

        return view('member.capstones.show', compact('capstone'));
    }

    public function edit($id)
    {
        $capstone = Capstone::findOrFail($id);
        
        // Authorization check - only team members can edit
        if (!in_array(auth()->user()->userid, [
            $capstone->anggota1_nim,
            $capstone->anggota2_nim,
            $capstone->anggota3_nim
        ])) {
            abort(403, 'Unauthorized action.');
        }
    
        return view('member.capstones.edit', compact('capstone'));
    }

    public function update(Request $request, $id)
    {
        $capstone = Capstone::findOrFail($id);
        
        // Validate request
        $validated = $request->validate([
            'kode_kelompok' => [
                'required',
                'regex:/^S[1-2]T\d{2}K\d{2}$/',
                Rule::unique('capstones')->ignore($capstone->id),
            ],
            'judul_capstone' => 'required',
            'kategori' => 'required',
            'anggota2_nim' => 'nullable|exists:students,nim',
            'anggota3_nim' => 'nullable|exists:students,nim',
            'c100' => 'nullable|file|mimes:pdf|max:2048',
            'c200' => 'nullable|file|mimes:pdf|max:2048',
            'c300' => 'nullable|file|mimes:pdf|max:2048',
            'c400' => 'nullable|file|mimes:pdf|max:2048',
            'c500' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        // Check if members are already in other teams
        foreach (['anggota2_nim', 'anggota3_nim'] as $field) {
            if ($request->filled($field) && $request->$field !== $capstone->$field) {
                $isAlreadyInTeam = Capstone::where('id', '!=', $capstone->id)
                    ->where(function($query) use ($request, $field) {
                        $query->where('anggota1_nim', $request->$field)
                            ->orWhere('anggota2_nim', $request->$field)
                            ->orWhere('anggota3_nim', $request->$field);
                    })
                    ->exists();
    
                if ($isAlreadyInTeam) {
                    return back()
                        ->withInput()
                        ->withErrors(["$field" => "NIM {$request->$field} sudah terlibat di capstone tim lain."]);
                }
            }
        }
    
        $data = $validated;
        
        // Handle folder rename if kode_kelompok changes
        if ($capstone->kode_kelompok !== $request->kode_kelompok) {
            $oldPath = 'public/capstone-documents/' . $capstone->kode_kelompok;
            $newPath = 'public/capstone-documents/' . $request->kode_kelompok;
            
            if (Storage::exists($oldPath)) {
                Storage::move($oldPath, $newPath);
            } else {
                Storage::makeDirectory($newPath);
            }
            
            // Update file paths in database
            foreach(['c100', 'c200', 'c300', 'c400', 'c500'] as $doc) {
                $pathField = $doc . '_path';
                if ($capstone->$pathField) {
                    $data[$pathField] = str_replace(
                        'capstone-documents/' . $capstone->kode_kelompok,
                        'capstone-documents/' . $request->kode_kelompok,
                        $capstone->$pathField
                    );
                }
            }
        }
    
        // Handle file uploads
        $folderPath = 'capstone-documents/' . $request->kode_kelompok;
        foreach(['c100', 'c200', 'c300', 'c400', 'c500'] as $doc) {
            if ($request->hasFile($doc)) {
                // Delete old file if exists
                $oldPathField = $doc . '_path';
                if ($capstone->$oldPathField) {
                    Storage::delete('public/' . $capstone->$oldPathField);
                }
                
                // Store new file
                $file = $request->file($doc);
                $filename = $doc . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/' . $folderPath, $filename);
                $data[$doc.'_path'] = $folderPath . '/' . $filename;
            } else {
                // Keep existing file path
                $pathField = $doc . '_path';
                if ($capstone->$pathField) {
                    $data[$pathField] = $capstone->$pathField;
                }
            }
        }
    
        $capstone->update($data);
    
        return redirect()->route('member.capstones.index')
        ->with('success', 'Capstone berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $capstone = Capstone::findOrFail($id);
            
            // Authorization check
            if ($capstone->anggota1_nim !== auth()->user()->userid) {
                abort(403, 'Unauthorized action. Only team leader can delete the capstone.');
            }
            
            // Delete all associated PDF files first
            $documents = ['c100_path', 'c200_path', 'c300_path', 'c400_path', 'c500_path'];
            foreach ($documents as $doc) {
                if ($capstone->$doc) {
                    // Delete the file from storage
                    Storage::delete('public/' . $capstone->$doc);
                }
            }
            
            // Delete the folder if it exists
            $folderPath = 'public/capstone-documents/' . $capstone->kode_kelompok;
            if (Storage::exists($folderPath)) {
                Storage::deleteDirectory($folderPath);
            }
            
            // Finally delete the database record
            $capstone->delete();
            
            return redirect()->route('member.capstones.index')
                ->with('success', 'Capstone dan semua dokumen terkait berhasil dihapus.');
                
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting capstone: ' . $e->getMessage());
            
            return redirect()->route('member.capstones.index')
                ->with('error', 'Terjadi kesalahan saat menghapus capstone. Silakan coba lagi.');
        }
    }
}
