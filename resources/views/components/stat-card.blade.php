@props([
    'judul' => '',
    'nilai' => '0',
    'ikon' => 'bi-pie-chart',
    'warna' => 'primary'
])

<div class="card border-0 shadow-sm h-100">
    <div class="card-body d-flex align-items-center">
        <div class="bg-{{ $warna }} bg-opacity-10 text-{{ $warna }} rounded p-3 me-3">
            <i class="bi {{ $ikon }} fs-4"></i>
        </div>
        <div>
            <div class="text-body-secondary small">{{ $judul }}</div>
            <div class="fs-4 fw-semibold">
                {{ $nilai }}
            </div>
        </div>
    </div>
</div>