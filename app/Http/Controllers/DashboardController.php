<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Krs;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total data dari masing-masing tabel secara otomatis
        $totalMahasiswa = Mahasiswa::count();
        $totalMatakuliah = Matakuliah::count();
        $totalKrs = Krs::count();

        // Mengirim variabel data statistik ke view 'dashboard'
        return view('dashboard', compact('totalMahasiswa', 'totalMatakuliah', 'totalKrs'));
    }
}