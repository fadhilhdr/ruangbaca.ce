<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Lecturer;
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
            'identifier' => 'required|string', // Nama atau NIM
            'instansi' => 'nullable|string',
        ]);

        $identifier = $request->input('identifier');
        $instansi = $request->input('instansi', 'Teknik Komputer'); // Default instansi

        // Cari di database berdasarkan NIM/NIP
        $user = Student::where('nim', $identifier)->first() ?? Lecturer::where('nip', $identifier)->first() ?? Employee::where('nip', $identifier)->first();

        // Periksa apakah pengguna sudah check-in dan belum checkout
        $existingVisitor = Visitor::where(function ($query) use ($identifier) {
            $query->where('userid', $identifier)
                ->orWhere('name', $identifier);
        })->whereNull('check_out_at')->first();

        if ($existingVisitor) {
            // Jika sudah check-in, tampilkan konfirmasi untuk checkout
            return view('visitor.confirm_checkout', [
                'visitor' => $existingVisitor,
            ]);
        }

        if ($user) {
            // Jika user terdaftar, gunakan data dari database
            $name = $user->name;

            // Simpan data ke tabel visitor
            Visitor::create([
                'userid' => $identifier,
                'name' => $name,
                'instansi' => 'Teknik Komputer', // Instansi default
                'check_in_at' => now(),
            ]);

            return redirect()->route('visitor.index')->with('success', "Selamat datang, $name!");
        }

        if (!empty($instansi)) {
            // Simpan data untuk pengunjung tanpa NIM/NIP
            Visitor::create([
                'userid' => null,
                'name' => $identifier,
                'instansi' => $instansi,
                'check_in_at' => now(),
            ]);

            return redirect()->route('visitor.index')->with('success', "Selamat datang, $identifier!");
        }

        // Jika Nama dan NIM tidak ditemukan di database
        return redirect()->back()->with('error', 'Data tidak ditemukan di database. Tolong masukkan Nama dan Instansi Anda.');
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

    public function index(Request $request)
    {

        $todayVisitors = Visitor::whereDate('check_in_at', Carbon::today())->get();
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