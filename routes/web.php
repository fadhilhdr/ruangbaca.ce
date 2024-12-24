<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\VisitorController;
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

Route::post('/visitor', [VisitorController::class, 'store'])->name('visitor.store');
Route::get('/visitor', [VisitorController::class, 'index'])->name('visitor.index');

// Rute registrasi pengguna
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Rute profil pengguna yang hanya bisa diakses oleh pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute pengalihan otomatis ke dashboard berdasarkan peran pengguna setelah login
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Cek role pengguna dan arahkan ke dashboard yang sesuai
    if ($user->role->name === 'Member') {
        return redirect()->route('member.dashboard');
    } elseif ($user->role->name === 'Admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role->name === 'Superadmin') {
        return redirect()->route('superadmin.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');
// Rute untuk dashboard berdasarkan role pengguna (admin, member, superadmin)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/superadmin/dashboard', 'superadmin.dashboard')->name('superadmin.dashboard');
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/member/dashboard', 'member.dashboard')->name('member.dashboard');
});

require __DIR__.'/auth.php';