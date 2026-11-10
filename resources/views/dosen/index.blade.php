@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Dosen</h5>
                    <a href="{{ route('dosen.create') }}" class="btn btn-light btn-sm fw-bold">+ Tambah Dosen</a>
                </div>

                <div class="card-body">
                    <!-- Notifikasi Sukses Session -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <!-- Perhatikan ID tabel harus 'table-dosen' sesuai script DataTables -->
                        <table id="table-dosen" class="table table-bordered table-striped align-middle w-100">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>NIDN</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan dimuat secara otomatis oleh Yajra DataTables via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- CDN DataTables & SweetAlert2 (jika belum ada di layout utama) -->
<script>
$(document).ready(function() {
    // Inisialisasi Yajra DataTables Server-Side
    $('#table-dosen').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dosen.data') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
            { data: 'nidn', name: 'nidn' },
            { data: 'nama', name: 'nama' },
            { data: 'email', name: 'email' },
            { data: 'telepon', name: 'telepon' },
            { data: 'aksi', name: 'aksi', orderable: false, searchable: false, className: 'text-center' }
        ]
    });

    // Handle Tombol Hapus (Sampah) berbasis AJAX & SweetAlert2
    $(document).on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        let nama = $(this).data('nama');

        Swal.fire({
            title: 'Hapus data ' + nama + '?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('dosen') }}/" + id,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire('Terhapus!', response.message, 'success');
                        $('#table-dosen').DataTable().ajax.reload(); // Refresh tabel otomatis tanpa reload halaman
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan pada server.';
                        Swal.fire('Gagal!', msg, 'error');
                    }
                });
            }
        });
    });
});
</script>
@endpush