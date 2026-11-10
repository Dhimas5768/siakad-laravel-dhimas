<a href="{{ route('mahasiswa.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit">
    <i class="bi bi-pencil-square"></i>
</a>
<button onclick="deleteData('{{ route('mahasiswa.destroy', $row->id) }}')" class="btn btn-danger btn-sm" title="Hapus">
    <i class="bi bi-trash"></i>
</button>