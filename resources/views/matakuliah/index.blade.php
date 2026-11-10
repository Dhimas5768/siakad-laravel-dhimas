@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
    <x-page-header judul="Data Mata Kuliah" 
                 deskripsi="Pencarian dan pengurutan diproses di server." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Daftar Mata Kuliah</span>
            @if (Route::has('matakuliah.create'))
                @if (Auth::user()?->role === 'admin')
                    <a href="{{ route('matakuliah.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah Mata Kuliah
                    </a>
                @endif
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-matakuliah" 
                       class="table table-striped table-hover align-middle w-100">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(function () {
    $('#tabel-matakuliah').DataTable({
        processing: true,
        serverSide: true,
        ajax: @json(route('matakuliah.data', [], false)),
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kode_mk', name: 'kode_mk' },
            { data: 'nama_mk', name: 'nama_mk' },
            { data: 'sks', name: 'sks' },
            { data: 'aksi', name: 'aksi', className: 'text-nowrap', orderable: false, searchable: false },
        ],
        order: [[2, 'asc']],
        language: {
            processing: 'Memuat data...',
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data',
            infoFiltered: '(disaring dari _MAX_ data)',
            zeroRecords: 'Data tidak ditemukan',
            paginate: {
                first: 'Awal', last: 'Akhir',
                next: 'Berikutnya', previous: 'Sebelumnya',
            },
        },
    });
});

function deleteData(url) {
    if (confirm('Apakah Anda yakin ingin menghapus data mata kuliah ini?')) {
        $.post(url, {
            '_token': '{{ csrf_token() }}',
            '_method': 'DELETE'
        }, function (response) {
            $('#tabel-matakuliah').DataTable().ajax.reload();
            alert(response.message || 'Data berhasil dihapus.');
        }).fail(function () {
            alert('Gagal menghapus data.');
        });
    }
}
</script>
@endpush