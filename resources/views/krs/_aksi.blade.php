<div class="d-flex justify-content-center gap-1">
    <a href="{{ route('krs.pdf', $row->id) }}" class="btn btn-success btn-sm" target="_blank" title="Cetak PDF">
        <i class="bi bi-file-earmark-pdf"></i>
    </a>
    <form action="{{ route('krs.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data KRS ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>