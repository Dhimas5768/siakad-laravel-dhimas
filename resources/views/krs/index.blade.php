@extends('layouts.app')

@section('title', 'Data Kartu Rencana Studi (KRS)')

@section('content')
    <x-page-header judul="Kartu Rencana Studi (KRS)" 
                 deskripsi="Kelola daftar rencana studi mahasiswa dengan Yajra DataTables." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Daftar KRS Mahasiswa</span>
            <a href="{{ route('krs.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Tambah KRS
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table id="tabel-krs" class="table table-striped table-hover align-middle w-100">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th width="20%">NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th width="20%">Semester</th>
                            <th width="15%" class="text-center">Aksi</th>
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
    $('#tabel-krs').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("krs.data") }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nim', name: 'nim' },
            { data: 'nama_mahasiswa', name: 'nama_mahasiswa' },
            { data: 'semester', name: 'semester' },
            { data: 'aksi', name: 'aksi', className: 'text-center text-nowrap', orderable: false, searchable: false },
        ],
        order: [[1, 'asc']],
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
    if (confirm('Apakah Anda yakin ingin menghapus data KRS ini?')) {
        $.post(url, {
            '_token': '{{ csrf_token() }}',
            '_method': 'DELETE'
        }, function (response) {
            $('#tabel-krs').DataTable().ajax.reload();
            alert(response.message || 'Data berhasil dihapus.');
        }).fail(function () {
            alert('Gagal menghapus data.');
        });
    }
}
</script>
@endpush