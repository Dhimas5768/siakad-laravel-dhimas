@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header judul="Detail Mahasiswa" deskripsi="Informasi lengkap mahasiswa." />

    <div class="card border-0 shadow-sm col-md-6">
        <div class="card-header bg-body fw-semibold">Kartu Mahasiswa</div>
        <div class="card-body">
            <p><strong>NIM:</strong> {{ $mhs['nim'] }}</p>
            <p><strong>Nama:</strong> {{ $mhs['nama'] }}</p>
            <p><strong>Prodi:</strong> {{ $mhs['prodi'] ?? 'Teknik Informatika' }}</p>
            <p><strong>Angkatan:</strong> {{ $mhs['angkatan'] ?? '2024' }}</p>
            <p><strong>Status:</strong> <span class="badge bg-success">{{ $mhs['status'] }}</span></p>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-sm mt-2">Kembali</a>
        </div>
    </div>
@endsection