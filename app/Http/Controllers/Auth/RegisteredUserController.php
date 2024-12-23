<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Employee;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        // Validasi input dari form registrasi
        $request->validate([
            'userid' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Cari data di tabel students, lecturers, atau employees
        $userData = Student::where('nim', $request->userid)->first()
            ?? Lecturer::where('nip', $request->userid)->first()
            ?? Employee::where('nip', $request->userid)->first();

        // Jika data tidak ditemukan, kembalikan error
        if (!$userData) {
            return back()->withErrors(['userid' => 'Data tidak ditemukan.'])->withInput();
        }

        // Cek apakah pengguna sudah terdaftar di tabel users
        if (User::where('userid', $request->userid)->exists()) {
            return back()->withErrors(['userid' => 'Pengguna sudah terdaftar.'])->withInput();
        }

        // Tetapkan role default sebagai 1 (member)
        $roleId = 1; // Semua pengguna akan memiliki role member secara default

        // Simpan data pengguna ke tabel users
        $user = User::create([
            'userid' => $request->userid,
            'name' => $userData->name, // Ambil nama dari tabel yang ditemukan
            'password' => Hash::make($request->password),
            'role_id' => $roleId,
        ]);

        // Event untuk proses registrasi dan otomatis login
        event(new Registered($user));
        Auth::login($user);

        // Redirect ke halaman utama setelah registrasi berhasil
        return redirect(RouteServiceProvider::HOME);
    }
}
