<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\KrsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Tamu (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.attempt');
});

// Rute Terautentikasi (Auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return view('dashboard', [
            'kolom' => ['No', 'Kode', 'Mata Kuliah', 'SKS', 'Semester'],
            'krs' => [],
            'statusKrs' => [
                ['label' => 'Disetujui', 'persen' => '100%', 'warna' => 'success'],
            ],
        ]);
    });

    Route::get('/dashboard', function () {
        return view('dashboard', [
            'kolom' => ['No', 'Kode', 'Mata Kuliah', 'SKS', 'Semester'],
            'krs' => [],
            'statusKrs' => [
                ['label' => 'Disetujui', 'persen' => '100%', 'warna' => 'success'],
            ],
        ]);
    })->name('dashboard');

    // ==========================================
    // Data Mahasiswa (Jobsheet 11)
    // ==========================================
    Route::get('/mahasiswa/data', [MahasiswaController::class, 'data'])->name('mahasiswa.data');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class)
            ->except(['index', 'show']);
    });

    Route::resource('mahasiswa', MahasiswaController::class)
        ->only(['index', 'show']);

    // ==========================================
    // Data Dosen (Jobsheet 11)
    // ==========================================
    Route::get('/dosen/data', [DosenController::class, 'data'])->name('dosen.data');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('dosen', DosenController::class)
            ->except(['index', 'show']);
    });

    Route::resource('dosen', DosenController::class)
        ->only(['index', 'show']);

    // ==========================================
    // Data Mata Kuliah
    // ==========================================
    Route::get('/matakuliah/data', [MataKuliahController::class, 'data'])->name('matakuliah.data');

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('matakuliah', MataKuliahController::class)
            ->except(['index', 'show']);
    });

    Route::resource('matakuliah', MataKuliahController::class)
        ->only(['index', 'show']);

    // ==========================================
    // KRS (Kartu Rencana Studi)
    // ==========================================
    Route::get('/krs/data', [KrsController::class, 'data'])->name('krs.data');
    Route::get('/krs/{krs}/pdf', [KrsController::class, 'cetakPdf'])->name('krs.pdf');
    Route::resource('krs', KrsController::class);
});