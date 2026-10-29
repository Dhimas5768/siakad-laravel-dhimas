<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Definisi Kolom untuk Tabel KRS
        $kolom = [
            'nim'           => 'NIM',
            'nama'          => 'Nama Mahasiswa',
            'sks'           => 'SKS',
            'status'        => 'Status',
        ];

        // 2. Data Contoh KRS
        $krs = [
            ['nim' => '2401001', 'nama' => 'Ahmad Fauzi',   'sks' => 22, 'status' => 'Disetujui'],
            ['nim' => '2401002', 'nama' => 'Siti Rahmawati', 'sks' => 20, 'status' => 'Disetujui'],
            ['nim' => '2301005', 'nama' => 'Budi Santoso',   'sks' => 24, 'status' => 'Menunggu'],
            ['nim' => '2301012', 'nama' => 'Dewi Lestari',   'sks' => 18, 'status' => 'Menunggu'],
            ['nim' => '2201020', 'nama' => 'Rizky Pratama',  'sks' => 21, 'status' => 'Disetujui'],
        ];

        // 3. Data Progress Bar Status KRS
        $statusKrs = [
            ['label' => 'Disetujui', 'persen' => 70, 'warna' => 'success'],
            ['label' => 'Menunggu',  'persen' => 22, 'warna' => 'warning'],
            ['label' => 'Ditolak',   'persen' => 8,  'warna' => 'danger'],
        ];

        // Pass variabel $kolom, $krs, dan $statusKrs ke view dashboard
        return view('dashboard', compact('kolom', 'krs', 'statusKrs'));
    }
}