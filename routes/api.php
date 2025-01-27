<?php

use App\Http\Controllers\BookLoanController;
use App\Http\Controllers\CapstoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/validate-kode-unik/{kode}/{isbn}', [BookLoanController::class, 'validateKodeUnik']);
Route::get('/validate-renew-kode-unik/{kodeUnik}/{loanId}', [BookLoanController::class, 'validateRenewKodeUnik']);
Route::get('/validate-return-kode-unik/{kodeUnik}/{loanId}', [BookLoanController::class, 'validateReturnKodeUnik']);


Route::get('/check-nim/{nim}', [CapstoneController::class, 'checkNim']);
Route::get('/check-kode/{kode}', [CapstoneController::class, 'checkKode']);