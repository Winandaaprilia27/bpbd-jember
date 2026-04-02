<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KenaikanGajiController;
use Illuminate\Support\Facades\Route;

// Route Auth (tanpa middleware)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Register (opsional)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    // Dashboard - Gunakan DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [AuthController::class, 'changePassword'])->name('profile.change-password');
    
    // Route Pegawai
    Route::resource('pegawai', PegawaiController::class);
    Route::get('pegawai/{pegawai}/print', [PegawaiController::class, 'print'])->name('pegawai.print');
    Route::get('pegawai/{pegawai}/riwayat-hidup', [PegawaiController::class, 'riwayatHidup'])->name('pegawai.riwayat-hidup');
    
    // Route Kenaikan Gaji
    Route::prefix('kenaikan-gaji')->name('kenaikan-gaji.')->group(function () {
        Route::get('/', [KenaikanGajiController::class, 'index'])->name('index');
        Route::get('hitung/{pegawai}', [KenaikanGajiController::class, 'hitung'])->name('hitung');
        Route::post('simpan/{pegawai}', [KenaikanGajiController::class, 'simpan'])->name('simpan');
        Route::get('cetak/{kenaikanGaji}', [KenaikanGajiController::class, 'cetak'])->name('cetak');
    });
});

// Redirect root
Route::get('/', function () {
    return redirect()->route('login');
});