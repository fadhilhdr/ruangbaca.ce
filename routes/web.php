<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Employee;
use App\Models\Lecturer;
use App\Models\Student;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('/check-user/{userid}', function ($userid) {
    $user = Student::where('nim', $userid)->first()
        ?? Lecturer::where('nip', $userid)->first()
        ?? Employee::where('nip', $userid)->first();

    if ($user) {
        return response()->json(['success' => true, 'name' => $user->name]);
    }

    return response()->json(['success' => false, 'message' => 'User not found.']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
