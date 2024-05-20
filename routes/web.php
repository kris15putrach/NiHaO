<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoboflowController;



Route::get('/', function () {
    return view('tampilanutama');
    
});

Route::get('/input', function () {
    return view('diagnosa_input');
})->middleware('check.session');;

Route::get('/output', function () {
    return view('diagnosa_output');
})->middleware('check.session');;

Route::get('/beranda_pembudidaya', function () {
    return view('beranda_pembudidaya');
})->middleware('check.session');

Route::get('/beranda_admin', function () {
    return view('beranda_admin');
});

Route::get('/daftar', function () {
    return view('daftar');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/postingan', function () {
    return view('postkonten');
});
Route::get('/lupa', function () {
    return view('lupapassword');
});

Route::get('/verif', function () {
    return view('verifikasi_otp');
});



Route::get('/check-api-connection', [RoboflowController::class, 'checkApiConnection']);
Route::get('/test', [RoboflowController::class, 'index']);  
Route::post('/upload', [RoboflowController::class, 'upload'])->middleware('check.session');

use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\LoginController;


Route::post('/daftar', [RegistrasiController::class, 'daftar'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');


use App\Http\Controllers\UnggahController;
Route::post('/unggah', [UnggahController::class, 'unggah'])->name('unggah')->middleware('check.session');;

use App\Http\Controllers\KomunitasController;
Route::get('/komu', [KomunitasController::class, 'index'])->middleware('check.session');;

use App\Http\Controllers\AkunController;
Route::get('/adminakun', [AkunController::class, 'index']);
Route::delete('/akun/{id}', [AkunController::class, 'destroy']);

Route::post('/comments/store', [KomunitasController::class, 'storeComment'])->name('comments.store');



use App\Http\Controllers\CommentController;
Route::get('/kelolakomu', function () {
    return view('kelolakomunitas');
});
Route::get('/kelolakomu', [UnggahController::class, 'index']);
Route::delete('/unggah/{id}', [UnggahController::class, 'destroy']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);




Route::get('/riwayat_diagnosis', function () {
    return view('riwayatdiagnosis');
});
Route::get('/riwayat_diagnosis', [RoboflowController::class, 'showHistory'])->middleware('auth');

// Lupa pW

Route::get('/lupa', function () {
    return view('lupapassword');
});

Route::post('/request-otp', [LoginController::class, 'requestOtp'])->name('requestOtp');

Route::get('/verify-otp', [LoginController::class, 'showVerifyForm'])->name('showVerifyForm');

Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('verifyOtp');

Route::get('/reset', [LoginController::class, 'reset'])->name('reset');
// end

Route::get('/verif', function () {
    return view('verifikasi_otp');
});

Route::get('/otp', function () {
    return view('OTP_Fonnte');
});

// Route::get('/reset', function () {
//     return view('reset_password');
// });