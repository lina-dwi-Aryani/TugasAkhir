<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk Kegiatan
Route::middleware('role:admin,petugas')->group(function () {
    Route::resource('kegiatan', KegiatanController::class);
    Route::get('/bantul', [KegiatanController::class, 'bantul'])->name('kegiatan.bantul');
    Route::get('/gk', [KegiatanController::class, 'gk'])->name('kegiatan.gk');
    Route::get('/kota', [KegiatanController::class, 'kota'])->name('kegiatan.kota');
    Route::get('/kp', [KegiatanController::class, 'kp'])->name('kegiatan.kp');
    Route::get('/sleman', [KegiatanController::class, 'sleman'])->name('kegiatan.sleman');
});

// Rute untuk Export
Route::middleware('role:admin')->group(function () {
    Route::get('/export', [KegiatanController::class, 'export'])->name('export');
    Route::get('export/bantul', [ExportController::class, 'exportBantul'])->name('export.bantul');
    Route::get('export/sleman', [ExportController::class, 'exportSleman'])->name('export.sleman');
    Route::get('export/gk', [ExportController::class, 'exportGk'])->name('export.gk');
    Route::get('export/kota', [ExportController::class, 'exportKota'])->name('export.kota');
    Route::get('export/kp', [ExportController::class, 'exportKP'])->name('export.kp');
});

// Rute Dashboard
Route::middleware('role:admin,petugas')->group(function () {
    Route::resource('dashboard', DashboardController::class)->only(['index']);
    Route::get('/bulan-chart', [DashboardController::class, 'bulanChart'])->name('bulan_chart');
});

// Rute Auth
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rute User
Route::middleware('role:admin')->group(function () {
    Route::get('/create-user', [UserController::class, 'create']);
    Route::resource('users', UserController::class);
});
