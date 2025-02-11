<?php
namespace App\Http\Controllers;

use App\Models\Tugasakhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TugasakhirController extends Controller
{
    public function index(Request $request)
    {
        // Base query with user relationship for getting names
        $query = Tugasakhir::with(['user:userid,name']);
        
        // Search logic
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('nim', 'like', '%' . $keyword . '%')
                    ->orWhereHas('user', function($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }
        
        // Filter logic
        if ($request->has('filter') && $request->filter != '') {
            $filter = $request->filter;
            $filterValue = $request->input('filter_value');
            
            if ($filterValue) {
                switch ($filter) {
                    case 'title':
                        $query->where('title', 'like', '%' . $filterValue . '%');
                        break;
                    case 'nim':
                        $query->where('nim', 'like', '%' . $filterValue . '%');
                        break;
                    case 'name':
                        $query->whereHas('user', function($q) use ($filterValue) {
                            $q->where('name', 'like', '%' . $filterValue . '%');
                        });
                        break;
                }
            }
        }
        
        // Sort logic
        $sortField = $request->input('sort', 'created_at'); // default sort by created_at
        $sortDirection = $request->input('direction', 'desc'); // default direction is descending
        
        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['title', 'created_at', 'user'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        
        // Handle user (penulis) sorting separately since it's a relationship
        if ($sortField === 'user') {
            $query->leftJoin('users', 'tugasakhirs.nim', '=', 'users.userid')
                  ->select('tugasakhirs.*', 'users.name as user_name')
                  ->orderBy('users.name', $sortDirection);
        } else {
            $query->orderBy($sortField, $sortDirection);
        }
        
        $tugasakhirs = $query->paginate(10)
                             ->appends($request->query());
        
        // Pass sort parameters to the view for maintaining state
        return view('public.tugasakhirs.index', compact('tugasakhirs', 'sortField', 'sortDirection'));
    }

    public function memberIndex()
    {
        $tugasakhirs = Tugasakhir::where('nim', auth()->user()->userid)->get();
        return view('member.tugasakhirs.index', compact('tugasakhirs'));
    }

    public function show($id)
    {
        $tugasakhir = Tugasakhir::with('user')->findOrFail($id);
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
        // Define file size limits and error messages
        $fileSizeLimits = [
            'full_document'        => 15, // 15 MB
            'cover_abstract'       => 5,  // 5 MB
            'bab1_pendahuluan'     => 5,
            'bab2_kajianpustaka'   => 5,
            'bab3_perancangan'     => 5,
            'bab4_hasilpembahasan' => 10,
            'bab5_penutup'         => 5,
            'lampiran'             => 10,
        ];

        // Custom validation messages
        $messages = [
            'title.max'  => 'Judul tugas akhir tidak boleh lebih dari 255 karakter.',
            '*.required' => 'Mohon unggah dokumen :attribute.',
            '*.mimes'    => 'Dokumen :attribute harus dalam format PDF.',
        ];

        // Dynamic file size validation
        $sizeRules = [];
        foreach ($fileSizeLimits as $field => $limit) {
            $sizeRules[$field] = [
                'required',
                'mimes:pdf',
                'max:' . ($limit * 1024), // Convert MB to KB
                function ($attribute, $value, $fail) use ($limit) {
                    $fileSize = $value->getSize() / 1024 / 1024; // Convert to MB
                    if ($fileSize > $limit) {
                        $fail("Ukuran dokumen $attribute tidak boleh melebihi $limit MB.");
                    }
                },
            ];
        }

        // Merge validation rules
        $validationRules = array_merge([
            'title' => 'required|string|max:255',
        ], $sizeRules);

        // Validate request
        try {
            $validatedData = $request->validate($validationRules, $messages);

            $data        = $request->all();
            $nim         = auth()->user()->userid;
            $data['nim'] = $nim;

            // Create a folder for the specific NIM under tugasakhirs
            $folderPath = 'tugasakhirs/' . $nim;

            // Store files with custom naming
            $fileFields = [
                'full_document'        => 'full_document',
                'cover_abstract'       => 'cover_abstract',
                'bab1_pendahuluan'     => 'bab1_pendahuluan',
                'bab2_kajianpustaka'   => 'bab2_kajianpustaka',
                'bab3_perancangan'     => 'bab3_perancangan',
                'bab4_hasilpembahasan' => 'bab4_hasilpembahasan',
                'bab5_penutup'         => 'bab5_penutup',
                'lampiran'             => 'lampiran',
            ];

            foreach ($fileFields as $field => $prefix) {
                if ($request->hasFile($field)) {
                    $file         = $request->file($field);
                    $filename     = $nim . '_' . $prefix . '.' . $file->getClientOriginalExtension();
                    $path         = $file->storeAs('public/' . $folderPath, $filename);
                    $data[$field] = $folderPath . '/' . $filename;
                }
            }

            Tugasakhir::create($data);

            return redirect()->route('member.tugasakhirs.index')
                ->with('success', 'Tugas Akhir berhasil diunggah.');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan dalam pengisian form.');
        }
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

        // Define file size limits (MB)
        $fileSizeLimits = [
            'full_document'        => 15,
            'cover_abstract'       => 5,
            'bab1_pendahuluan'     => 5,
            'bab2_kajianpustaka'   => 5,
            'bab3_perancangan'     => 5,
            'bab4_hasilpembahasan' => 10,
            'bab5_penutup'         => 5,
            'lampiran'             => 10,
        ];

        // Custom validation messages
        $messages = [
            'title.max' => 'Judul tugas akhir tidak boleh lebih dari 255 karakter.',
            '*.mimes'   => 'Dokumen :attribute harus dalam format PDF.',
        ];

        // Dynamic file size validation
        $sizeRules = [];
        foreach ($fileSizeLimits as $field => $limit) {
            $sizeRules[$field] = [
                'nullable',
                'mimes:pdf',
                'max:' . ($limit * 1024), // Convert MB to KB
                function ($attribute, $value, $fail) use ($limit) {
                    if ($value && $value->getSize() / 1024 / 1024 > $limit) {
                        $fail("Ukuran dokumen $attribute tidak boleh melebihi $limit MB.");
                    }
                },
            ];
        }

        // Merge validation rules
        $validationRules = array_merge([
            'title' => 'required|string|max:255',
        ], $sizeRules);

        // Validate request
        try {
            $validatedData = $request->validate($validationRules, $messages);

            $data       = $request->only(['title']);
            $nim        = $tugasakhir->nim;
            $folderPath = 'tugasakhirs/' . $nim;

            $fileFields = [
                'full_document'        => 'full_document',
                'cover_abstract'       => 'cover_abstract',
                'bab1_pendahuluan'     => 'bab1_pendahuluan',
                'bab2_kajianpustaka'   => 'bab2_kajianpustaka',
                'bab3_perancangan'     => 'bab3_perancangan',
                'bab4_hasilpembahasan' => 'bab4_hasilpembahasan',
                'bab5_penutup'         => 'bab5_penutup',
                'lampiran'             => 'lampiran',
            ];

            foreach ($fileFields as $field => $prefix) {
                if ($request->hasFile($field)) {
                    // Delete old file if exists
                    if ($tugasakhir->$field) {
                        Storage::disk('public')->delete($tugasakhir->$field);
                    }

                    // Store new file
                    $file         = $request->file($field);
                    $filename     = $nim . '_' . $prefix . '.' . $file->getClientOriginalExtension();
                    $path         = $file->storeAs('public/' . $folderPath, $filename);
                    $data[$field] = $folderPath . '/' . $filename;
                }
            }

            $tugasakhir->update($data);

            return redirect()->route('member.tugasakhirs.show', $tugasakhir->id)
                ->with('success', 'Tugas Akhir berhasil diperbarui.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan dalam pengisian form.');
        }
    }
}