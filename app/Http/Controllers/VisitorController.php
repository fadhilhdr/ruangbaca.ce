<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'userid' => 'nullable|string',
            'name' => 'nullable|string',
            'instansi' => 'nullable|string',
        ]);
    
        $userid = $request->input('userid');
        $name = $request->input('name');
        $instansi = $request->input('instansi', 'Teknik Komputer'); // Default instansi dengan kapital yang benar
    
        // Jika ada userid (NIM/NIP), cari pengguna
        $user = Student::where('nim', $userid)->first()
            ?? Lecturer::where('nip', $userid)->first()
            ?? Employee::where('nip', $userid)->first();
    
        if ($user) {
            $name = $user->name;
            $instansi = 'Teknik Komputer'; // Instansi otomatis jika terdaftar
    
            // Simpan data ke tabel visitor
            Visitor::create([
                'userid' => $userid,
                'name' => $name,
                'instansi' => $instansi,
                'check_in_at' => now(),
            ]);
    
            // Redirect dengan notifikasi sukses
            return redirect()->route('visitor.index')->with('success', "Selamat datang, $name!");
        }
    
        // Jika NIM/NIP tidak ditemukan dan nama tidak diisi
        if (!$name) {
            return redirect()->back()->with('error', 'NIM/NIP tidak terdaftar, mohon masukan nama dan instansi.');
        }
    
        // Jika pengunjung tidak terdaftar, simpan data dengan nama dan instansi manual
        if (!$instansi) {
            return redirect()->back()->with('error', 'Mohon masukan instansi.');
        }
    
        // Simpan data ke tabel visitor
        Visitor::create([
            'userid' => $userid,
            'name' => $name,
            'instansi' => $instansi,
            'check_in_at' => now(),
        ]);
    
        // Redirect dengan notifikasi sukses
        return redirect()->route('visitor.index')->with('success', "Selamat datang, $name!");
    }
    
    
    

    public function index()
    {
        $todayVisitors = Visitor::whereDate('check_in_at', Carbon::today())->get();

        return view('visitor.index', compact('todayVisitors'));
    }
}