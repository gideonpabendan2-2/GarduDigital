<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BelajarController;

// Halaman utama otomatis diarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang Membutuhkan Autentikasi
Route::middleware(['auth'])->group(function () {
    
    // Area Siswa
    Route::middleware(['role:siswa'])->group(function () {
        Route::get('/dashboard/siswa', [DashboardController::class, 'indexSiswa'])->name('dashboard.siswa');
        
        // Fitur Dasbor Tambahan
        Route::get('/siswa/misi', [\App\Http\Controllers\MisiController::class, 'indexSiswa'])->name('siswa.misi');
        Route::get('/siswa/bermain', [\App\Http\Controllers\PermainanController::class, 'indexSiswa'])->name('siswa.bermain');
        Route::get('/siswa/literasi', [\App\Http\Controllers\LiterasiDigitalController::class, 'indexSiswa'])->name('siswa.literasi');
        Route::get('/siswa/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('siswa.leaderboard');

        // Rute Gamifikasi Belajar
        Route::get('/belajar/peta/{id}', [BelajarController::class, 'petaMateri'])->name('belajar.peta');
        Route::get('/belajar/kuis/{id}', [BelajarController::class, 'mulaiKuis'])->name('belajar.kuis');
        Route::post('/belajar/kuis/{id}/submit', [BelajarController::class, 'submitKuis'])->name('belajar.kuis.submit');
    });

    // Area Guru
    Route::middleware(['role:guru'])->group(function () {
        Route::get('/dashboard/guru', [DashboardController::class, 'indexGuru'])->name('dashboard.guru');
    });

    // Area Orang Tua
    Route::middleware(['role:orang_tua'])->group(function () {
        Route::get('/dashboard/orang-tua', [DashboardController::class, 'indexOrangTua'])->name('dashboard.orang_tua');
    });

    // Area Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'indexAdmin'])->name('dashboard.admin');
        
        // Tindakan Cepat Admin
        Route::get('/admin/pengguna/create', [\App\Http\Controllers\Admin\PenggunaController::class, 'create'])->name('admin.pengguna.create');
        Route::post('/admin/pengguna', [\App\Http\Controllers\Admin\PenggunaController::class, 'store'])->name('admin.pengguna.store');

        Route::get('/admin/pengumuman/create', [\App\Http\Controllers\Admin\PengumumanController::class, 'create'])->name('admin.pengumuman.create');
        Route::post('/admin/pengumuman', [\App\Http\Controllers\Admin\PengumumanController::class, 'store'])->name('admin.pengumuman.store');

        Route::get('/admin/backup', [\App\Http\Controllers\Admin\BackupController::class, 'download'])->name('admin.backup.download');
    });

});
