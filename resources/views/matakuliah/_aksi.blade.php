<div class="d-flex justify-content-center gap-1">
    <a href="{{ route('matakuliah.edit', $row->id) }}" class="btn btn-warning btn-sm text-white" title="Edit">
        <i class="bi bi-pencil-square"></i>
    </a>
    <button type="button" class="btn btn-danger btn-sm" onclick="deleteData('{{ route('matakuliah.destroy', $row->id) }}')" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</div>