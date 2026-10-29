<?php

namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil 10 mahasiswa pertama
        $mahasiswaList = Mahasiswa::limit(10)->get();

        foreach ($mahasiswaList as $mhs) {
            $krs = Krs::create([
                'mahasiswa_id'   => $mhs->id,
                'tahun_akademik' => '2026/2027',
                'semester'       => 'Ganjil',
            ]);

            // Ambil 5 mata kuliah acak
            $mkIds = MataKuliah::inRandomOrder()->limit(5)->pluck('id');

            // Attach ke relasi mataKuliah
            $krs->mataKuliah()->attach($mkIds);
        }
    }
}