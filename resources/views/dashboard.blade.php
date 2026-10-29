@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <x-page-header judul="Dashboard"
                   deskripsi="Ringkasan data akademik (data sementara)." />

     KARTU STATISTIK
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-2-4 col-xl">
            <x-stat-card judul="Mahasiswa" nilai="1.250" ikon="bi-people" warna="primary" />
        </div>
        <div class="col-12 col-sm-6 col-lg-2-4 col-xl">
            <x-stat-card judul="Dosen" nilai="68" ikon="bi-person-badge" warna="success" />
        </div>
        <div class="col-12 col-sm-6 col-lg-2-4 col-xl">
            <x-stat-card judul="Mata Kuliah" nilai="94" ikon="bi-book" warna="warning" />
        </div>
        <div class="col-12 col-sm-6 col-lg-2-4 col-xl">
            <x-stat-card judul="KRS Aktif" nilai="842" ikon="bi-file-earmark-text" warna="info" />
        </div>
        <div class="col-12 col-sm-6 col-lg-2-4 col-xl">
            <x-stat-card judul="Rata-rata SKS per KRS" nilai="21.5" ikon="bi-calculator" warna="danger" />
        </div>
    </div>

    {{-- TABEL KRS TERBARU & STATUS KRS --}}
    <div class="row g-3">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-body fw-semibold">KRS Terbaru</div>
                <div class="card-body p-0">
                    <x-tabel :kolom="$kolom" :baris="$krs" />
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-body fw-semibold">Status KRS</div>
                <div class="card-body">
                    @foreach ($statusKrs as $s)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>{{ $s['label'] }}</span>
                                <span class="fw-semibold">{{ $s['persen'] }}%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-{{ $s['warna'] }}"
                                     role="progressbar"
                                     style="width: {{ $s['persen'] }}%"
                                     aria-valuenow="{{ $s['persen'] }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    document.getElementById('btnToggleTheme').addEventListener('click', function () {
        const html = document.documentElement;
        const currentTheme = html.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        html.setAttribute('data-bs-theme', newTheme);

        const icon = document.getElementById('iconTheme');
        if (newTheme === 'dark') {
            icon.classList.replace('bi-moon-stars', 'bi-sun-fill');
        } else {
            icon.classList.replace('bi-sun-fill', 'bi-moon-stars');
        }
    });
</script>
@endpush