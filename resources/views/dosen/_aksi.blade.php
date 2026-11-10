<div class="d-flex justify-content-center align-items-center gap-1">
    <!-- Tombol Detail -->
    <a href="{{ route('dosen.show', $dosen->id) }}" class="btn btn-info btn-sm text-white px-2 py-1" title="Detail">
        <i class="fas fa-eye"></i>
    </a>
    
    <!-- Tombol Edit -->
    <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-warning btn-sm text-white px-2 py-1" title="Edit">
        <i class="fas fa-edit"></i>
    </a>
    
    <!-- Tombol Hapus / Sampah -->
    <button type="button" class="btn btn-danger btn-sm btn-delete px-2 py-1" data-id="{{ $dosen->id }}" data-nama="{{ $dosen->nama }}" title="Hapus">
        <i class="fas fa-trash"></i>
    </button>
</div>