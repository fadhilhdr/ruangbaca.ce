<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rute utama
Route::get('/', function () {
    return view('welcome');
});

// Rute pengelolaan visitor
Route::post('/visitor', [VisitorController::class, 'store'])->name('visitor.store');
Route::get('/visitor', [VisitorController::class, 'index'])->name('visitor.index');
Route::post('/visitor/confirmCheckout', [VisitorController::class, 'confirmCheckout'])->name('visitor.confirmCheckout');

// Rute registrasi pengguna
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Rute profil pengguna (hanya untuk pengguna yang sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute pengalihan otomatis ke dashboard berdasarkan peran pengguna setelah login
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Cek role pengguna dan arahkan ke dashboard yang sesuai
    switch ($user->role->name) {
        case 'Member':
            return redirect()->route('member.dashboard');
        case 'Admin':
            return redirect()->route('admin.dashboard');
        case 'Superadmin':
            return redirect()->route('superadmin.dashboard');
        default:
            abort(403, 'Unauthorized action.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute dashboard berdasarkan role pengguna
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.layouts.base'); // Pastikan file view `admin.dashboard` ada
    })->name('dashboard');
    Route::resource('students', StudentController::class); // Manage students
    Route::get('/upload-data', [StudentController::class, 'upload'])->name('students.upload');
    Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
});

Route::middleware(['auth', 'role:Superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('superadmin.layouts.base'); // Pastikan file view `superadmin.layouts.base` ada
    })->name('dashboard');
});

Route::middleware(['auth', 'role:Member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', function () {
        return view('member.dashboard'); // Pastikan file view `member.dashboard` ada
    })->name('dashboard');
});

#PUBLIC ROUTES

Route::prefix('public/books')->name('public.books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/{id}', [BookController::class, 'show'])->name('show');
});






// Include rute autentikasi default Laravel Breeze
require __DIR__ . '/auth.php';