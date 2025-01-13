<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Lecturer;
use App\Models\Pegawai;
use App\Models\Student;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'identifier' => 'required|string',
            'instansi' => 'nullable|string',
        ]);
    
        $identifier = $request->input('identifier');
        $name = null;
        $instansi = null;
    
        // Cek di tabel students
        $student = Student::where('nim', $identifier)->first();
        if ($student) {
            $name = $student->name;
            $instansi = $student->prodi;
        }
    
        // Jika tidak ditemukan di students, cek di pegawais
        if (!$student) {
            $pegawai = Pegawai::where('nip_nppu_nupk', $identifier)->first();
            if ($pegawai) {
                $name = $pegawai->nama_lengkap;
                $instansi = $pegawai->bagian;
            }
        }
    
        // Cek apakah pengunjung sudah check-in dan belum check-out
        $existingVisitor = Visitor::where('nim_nip_nppu_nupk', $identifier)
            ->whereNull('check_out_at')
            ->first();
    
        if ($existingVisitor) {
            return view('visitor.confirm_checkout', [
                'visitor' => $existingVisitor,
            ]);
        }
    
        // Jika ditemukan di database (student atau pegawai)
        if ($name && $instansi) {
            Visitor::create([
                'nim_nip_nppu_nupk' => $identifier,
                'name' => $name,
                'instansi' => $instansi,
                'check_in_at' => now(),
            ]);
    
            return redirect()->route('visitor.index')
                ->with('success', "Selamat datang, $name!");
        }
    
        // Jika tidak ditemukan di database, gunakan input manual
        if ($request->filled('instansi')) {
            Visitor::create([
                'nim_nip_nppu_nupk' => $identifier,
                'name' => $identifier, // menggunakan identifier sebagai nama
                'instansi' => $request->input('instansi'),
                'check_in_at' => now(),
            ]);
    
            return redirect()->route('visitor.index')
                ->with('success', "Selamat datang, $identifier!");
        }
    
        // Jika tidak ditemukan dan instansi kosong
        return redirect()->back()
            ->with('error', 'Data tidak ditemukan di database. Tolong masukkan Instansi Anda.')
            ->withInput();
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
        $todayVisitors = Visitor::whereDate('check_in_at', Carbon::today())
            ->orderByDesc('check_in_at')
            ->paginate(10);
        
        return view('visitor.index', compact('todayVisitors'));
    }
    
    public function adminVisitorController(Request $request)
    {
        $query = Visitor::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('instansi', 'LIKE', "%{$search}%");
        }

        // Paginasi data berdasarkan query
        $dataVisitor = $query->paginate(5);

        return view('admin.visitorData.index', compact('dataVisitor'));
    }

}