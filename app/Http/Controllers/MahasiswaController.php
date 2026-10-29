<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Data dummy mahasiswa
    protected $mahasiswa = [
        ['nim' => '2401001', 'nama' => 'Ahmad Fauzi',   'prodi' => 'Teknik Informatika', 'angkatan' => '2024', 'status' => 'Aktif'],
        ['nim' => '2401002', 'nama' => 'Siti Rahmawati', 'prodi' => 'Teknik Informatika', 'angkatan' => '2024', 'status' => 'Aktif'],
        ['nim' => '2301005', 'nama' => 'Budi Santoso',   'prodi' => 'Teknik Informatika', 'angkatan' => '2023', 'status' => 'Aktif'],
        ['nim' => '2301012', 'nama' => 'Dewi Lestari',   'prodi' => 'Teknik Informatika', 'angkatan' => '2023', 'status' => 'Aktif'],
        ['nim' => '2201020', 'nama' => 'Rizky Pratama',  'prodi' => 'Teknik Informatika', 'angkatan' => '2202', 'status' => 'Aktif'],
    ];

    public function index()
    {
        $kolom = [
            'nim'    => 'NIM',
            'nama'   => 'Nama Mahasiswa',
            'prodi'  => 'Program Studi',
            'status' => 'Status'
        ];

        $mahasiswa = $this->mahasiswa;

        return view('mahasiswa.index', compact('kolom', 'mahasiswa'));
    }

    public function show($nim)
    {
        // Cari data mahasiswa berdasarkan NIM
        $mhs = collect($this->mahasiswa)->firstWhere('nim', $nim);

        // Jika NIM tidak ditemukan, tampilkan error 404
        if (!$mhs) {
            abort(404);
        }

        return view('mahasiswa.show', compact('mhs'));
    }
}