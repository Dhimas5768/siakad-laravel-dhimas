<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PenggunaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Tamu (Guest)
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.attempt');
});

// Rute Terautentikasi (Auth)
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return view('dashboard', [
            'kolom'     => ['No', 'Kode', 'Mata Kuliah', 'SKS', 'Semester'],
            'krs'       => [],
            'statusKrs' => [
                ['label' => 'Disetujui', 'persen' => '100%', 'warna' => 'success'],
            ]
        ]);
    });

    Route::get('/dashboard', function () {
        return view('dashboard', [
            'kolom'     => ['No', 'Kode', 'Mata Kuliah', 'SKS', 'Semester'],
            'krs'       => [],
            'statusKrs' => [
                ['label' => 'Disetujui', 'persen' => '100%', 'warna' => 'success'],
            ]
        ]);
    })->name('dashboard');

    Route::get('/matakuliah', function () {
        return view('matakuliah.index');
    })->name('matakuliah.index');

    Route::get('/mahasiswa', function () {
        return view('mahasiswa.index');
    })->name('mahasiswa.index');

    Route::get('/dosen', function () {
        return view('dosen.index');
    })->name('dosen.index');

    Route::get('/krs', function () {
        return view('krs.index');
    })->name('krs.index');
});