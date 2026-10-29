@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
    <div class="mb-4">
        <h2>Data Pengguna</h2>
        <p class="text-muted">Akun login SIAKAD (khusus admin).</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">Daftar Pengguna</div>
        <div class="card-body p-0">
            <x-tabel :kolom="$kolom" :baris="$pengguna" />
        </div>
    </div>
@endsection