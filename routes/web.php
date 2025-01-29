<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BookLoanController as AdminBookLoanController;
use App\Http\Controllers\Admin\DokumentController;
use App\Http\Controllers\Admin\FinesBookController;
use App\Http\Controllers\Admin\HistoryOfController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\CapstoneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\EmployeeController;
use App\Http\Controllers\Superadmin\StudentController as SuperadminStudentController;
use App\Http\Controllers\TugasakhirController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rute utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/credit', function () {
    return view('credit');
})->name('credit');

// Rute visitor
Route::post('/visitor', [VisitorController::class, 'store'])->name('visitor.store');
Route::get('/visitor', [VisitorController::class, 'index'])->name('visitor.index');
Route::post('/visitor/confirmCheckout', [VisitorController::class, 'confirmCheckout'])->name('visitor.confirmCheckout');

// Rute public
Route::prefix('public')->name('public.')->group(function () {
    // Redirect dari /public ke /public/books
    Route::get('/', function () {
        return redirect()->route('public.books.index');
    })->name('index');

    // Books routes
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/{isbn}', [BookController::class, 'show'])->name('show');
    });

    // Tugas Akhir routes
    Route::prefix('tugasakhirs')->name('tugasakhirs.')->group(function () {
        Route::get('/', [TugasakhirController::class, 'index'])->name('index');
        Route::get('/{id}', [TugasakhirController::class, 'show'])->name('show');
    });

    // Capstone routes
    Route::prefix('capstones')->name('capstones.')->group(function () {
        Route::get('/', [CapstoneController::class, 'index'])->name('index');
        Route::get('/{id}', [CapstoneController::class, 'show'])->name('show');
    });
});

// Rute public (registrasi menjadi user)
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// Rute user (profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute user (dashboard berdasarkan role)
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

Route::middleware(['auth', 'role:Member'])->prefix('member')->name('member.')->group(function () {
    // Redirect dari /member ke /member/dashboard
    Route::get('/', function () {
        return redirect()->route('member.dashboard');
    })->name('index');

    // Dashboard Member
    Route::get('/dashboard', [BookLoanController::class, 'dashboard'])->name('dashboard');

    // Book Loans Routes
    Route::prefix('loans')->name('loans.')->group(function () {
        Route::get('/', [BookLoanController::class, 'index'])->name('index');
        Route::get('/history', [BookLoanController::class, 'history'])->name('history');
        Route::get('/{id}', [BookLoanController::class, 'show'])->name('show');

        // Borrow Routes

        Route::get('/borrow/{isbn}', [BookLoanController::class, 'showBorrowForm'])->name('borrowForm');
        Route::post('/borrow/{isbn}', [BookLoanController::class, 'borrowBook'])->name('borrow');

        // Di dalam group loans

        Route::get('/renew/{id}', [BookLoanController::class, 'showRenewForm'])->name('renewForm');
        Route::post('/renew/{id}', [BookLoanController::class, 'renewBook'])->name('renew');
        Route::get('/return/{id}', [BookLoanController::class, 'showReturnForm'])->name('returnForm');
        Route::post('/return/{id}', [BookLoanController::class, 'returnBook'])->name('return');

        // Fine payment routes
        Route::get('/payment/{id}', [BookLoanController::class, 'showPaymentForm'])->name('paymentForm');
        Route::post('/payment/{id}', [BookLoanController::class, 'storePayment'])->name('payment.store');

        // Lost book replacement routes
        Route::get('/replacement/{id}', [BookLoanController::class, 'showReplacementForm'])->name('replacementForm');
        Route::post('/replacement/{id}', [BookLoanController::class, 'storeReplacement'])->name('replacement.store');
    });

    // Tugas Akhir Routes
    Route::prefix('tugasakhirs')->name('tugasakhirs.')->group(function () {
        Route::get('/', [TugasakhirController::class, 'memberIndex'])->name('index');
        Route::get('/create', [TugasakhirController::class, 'create'])->name('create');
        Route::post('/', [TugasakhirController::class, 'store'])->name('store');
        Route::get('/{id}', [TugasakhirController::class, 'memberShow'])->name('show');
        Route::get('/{id}/edit', [TugasakhirController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TugasakhirController::class, 'update'])->name('update');
        Route::delete('/{id}', [TugasakhirController::class, 'destroy'])->name('destroy');
    });

    // Capstone Routes
    Route::prefix('capstones')->name('capstones.')->group(function () {
        Route::get('/', [CapstoneController::class, 'memberIndex'])->name('index');
        Route::get('/create', [CapstoneController::class, 'create'])->name('create');
        Route::post('/store', [CapstoneController::class, 'store'])->name('store');
        Route::get('/{id}', [CapstoneController::class, 'memberShow'])->name('show');
        Route::get('/{id}/edit', [CapstoneController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CapstoneController::class, 'update'])->name('update');
        Route::delete('/{id}', [CapstoneController::class, 'destroy'])->name('destroy');
    });
});

// Rute admin
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    })->name('index'); // Tambahkan rute untuk admin

    Route::get('/dashboard', [HistoryOfController::class, 'index'])->name('dashboard');
                                                           // Route::resource('/dashboard', HistoryOfController::class);
    Route::resource('students', StudentController::class); // Manage students
    Route::post('/students/create', [StudentController::class, 'import'])->name('students.import');
    Route::get('/download', [StudentController::class, 'downloadTemplate'])->name('download.template');

    Route::resource('document', DokumentController::class); //Manage document

    Route::resource('books', AdminBookController::class); // Manage books
    Route::post('/books/create', [AdminBookController::class, 'import'])->name('books.import');
    Route::get('/download-template', [AdminBookController::class, 'downloadTemplate'])->name('downloadBook.template');

    Route::resource('transaction', AdminBookLoanController::class); // Manage transaction
    Route::resource('fines', FinesBookController::class);           // Manage fines
    Route::get('visitor', [VisitorController::class, 'adminVisitorController'])->name('visitor.index');
    Route::patch('/admin/denda/{id}/update-status', [FinesBookController::class, 'updateStatus'])->name('denda.updateStatus');

    //Book History

});

// Rute Superadmin
Route::middleware(['auth', 'role:Superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('superadmin.dashboard');
    })->name('index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/students', SuperadminStudentController::class);

    Route::resource('/employees', EmployeeController::class);

    Route::resource('users', UsersController::class);
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');

});

// route 404

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// Include rute autentikasi default Laravel Breeze
require __DIR__ . '/auth.php';
