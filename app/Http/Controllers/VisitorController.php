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
    
        // Periksa apakah pengguna sudah check-in dan belum checkout
        $existingVisitor = Visitor::where('name', 'LIKE', "%$name%")
            ->where('instansi', 'LIKE', "%$instansi%")
            ->whereNull('check_out_at')
            ->first();
    
        if ($existingVisitor) {
            // Jika sudah check-in, tampilkan konfirmasi untuk checkout
            return view('visitor.confirm_checkout', [
                'visitor' => $existingVisitor,
            ]);
        }
    
        if ($user) {
            // Jika user terdaftar, gunakan data dari database
            $name = $user->name;
            $instansi = 'Teknik Komputer'; // Instansi otomatis jika terdaftar
    
            // Simpan data ke tabel visitor
            Visitor::create([
                'userid' => $userid,
                'name' => $name,
                'instansi' => $instansi,
                'check_in_at' => now(),
            ]);
    
            return redirect()->route('visitor.index')->with('success', "Selamat datang, $name!");
        }
    
        // Jika NIM/NIP tidak ditemukan dan nama tidak diisi
        if (!$name || !$instansi) {
            return redirect()->back()->with('error', 'Identitas tidak terdaftar, mohon masukkan nama dan instansi.');
        }
    
        // Simpan data untuk pengunjung tanpa NIM/NIP
        Visitor::create([
            'userid' => $userid,
            'name' => $name,
            'instansi' => $instansi,
            'check_in_at' => now(),
        ]);
    
        return redirect()->route('visitor.index')->with('success', "Selamat datang, $name!");
    }
    
    public function confirmCheckout(Request $request)
    {
        // Validasi input
        $visitorId = $request->input('visitor_id');
    
        // Temukan visitor berdasarkan ID
        $visitor = Visitor::findOrFail($visitorId);
    
        // Update checkout jika konfirmasi
        $visitor->update([
            'check_out_at' => now(),
        ]);
    
        return redirect()->route('visitor.index')->with('success', "Sampai jumpa, {$visitor->name}!");
    }
    


    public function index()
    {
        $todayVisitors = Visitor::whereDate('check_in_at', Carbon::today())->get();

        return view('visitor.index', compact('todayVisitors'));
    }
}
