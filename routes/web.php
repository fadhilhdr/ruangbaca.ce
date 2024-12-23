<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Employee;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Visitor;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Rute utama
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk menampilkan daftar visitor
Route::get('/visitor', function () {
    $visitors = Visitor::all();
    return view('visitor', compact('visitors'));
});

// Rute untuk proses check-in visitor
Route::post('/visitor/checkin', function (Illuminate\Http\Request $request) {
    $userid = $request->input('userid');
    $user = Student::where('nim', $userid)->first()
        ?? Lecturer::where('nip', $userid)->first()
        ?? Employee::where('nip', $userid)->first();

    if ($user) {
        // Jika user ditemukan, lanjutkan dengan proses check-in
        Visitor::create([
            'userid' => $userid,
            'name' => $user->name,
            'check_in_at' => now(),
        ]);
        return redirect()->route('welcome')->with('success', 'Anda telah berhasil check-in!');
    } else {
        // Jika user tidak ditemukan, arahkan ke halaman check-in untuk memasukkan nama
        return redirect()->route('visitor.checkin')->with('error', 'ID tidak terdaftar. Silakan masukkan nama.');
    }
});

// Rute untuk halaman check-in visitor (membuat rute ini yang sebelumnya hilang)
Route::get('/visitor/checkin', function () {
    return view('visitor_checkin');
})->name('visitor.checkin');

// Rute registrasi pengguna
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Rute pengalihan otomatis ke dashboard berdasarkan peran pengguna setelah login
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Cek role pengguna dan arahkan ke dashboard yang sesuai
    if ($user->role->name === 'member') {
        return redirect()->route('member.dashboard');
    } elseif ($user->role->name === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role->name === 'superadmin') {
        return redirect()->route('superadmin.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute profil pengguna yang hanya bisa diakses oleh pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk dashboard berdasarkan role pengguna (admin, member, superadmin)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/superadmin/dashboard', 'superadmin.dashboard')->name('superadmin.dashboard');
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/member/dashboard', 'member.dashboard')->name('member.dashboard');
});

require __DIR__.'/auth.php';