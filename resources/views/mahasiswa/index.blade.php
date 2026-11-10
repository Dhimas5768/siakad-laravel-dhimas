@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <x-page-header judul="Data Mahasiswa" 
                 deskripsi="Pencarian dan pengurutan diproses di server." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Daftar Mahasiswa</span>
            @if (Route::has('mahasiswa.create'))
                @if (Auth::user()?->role === 'admin')
                    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
                    </a>
                @endif
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-mahasiswa" 
                       class="table table-striped table-hover align-middle w-100">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
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
    $('#tabel-mahasiswa').DataTable({
        processing: true,
        serverSide: true,
        ajax: @json(route('mahasiswa.data', [], false)),
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nim', name: 'nim' },
            { data: 'nama', name: 'nama' },
            { data: 'program_studi', name: 'program_studi' },
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
    if (confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')) {
        $.post(url, {
            '_token': '{{ csrf_token() }}',
            '_method': 'DELETE'
        }, function (response) {
            $('#tabel-mahasiswa').DataTable().ajax.reload();
            alert(response.message || 'Data berhasil dihapus.');
        }).fail(function () {
            alert('Gagal menghapus data.');
        });
    }
}
</script>
@endpush