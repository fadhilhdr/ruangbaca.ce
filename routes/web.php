<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Employee;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Rute utama
Route::get('/', function () {
    return view('welcome');
});

// Rute registrasi
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Pengalihan otomatis ke dashboard berdasarkan role pengguna setelah login
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Periksa role pengguna dan arahkan ke dashboard sesuai
    if ($user->role->name === 'member') {
        return redirect()->route('member.dashboard');
    } elseif ($user->role->name === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role->name === 'superadmin') {
        return redirect()->route('superadmin.dashboard');
    }

    // Default ke dashboard utama jika tidak ada role yang cocok
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk dashboard berdasarkan role
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/superadmin/dashboard', 'superadmin.dashboard')->name('superadmin.dashboard');
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/member/dashboard', 'member.dashboard')->name('member.dashboard');
});

require __DIR__.'/auth.php';
