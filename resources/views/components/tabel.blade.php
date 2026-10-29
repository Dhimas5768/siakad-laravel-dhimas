<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                @foreach ($kolom as $th)
                    <th>{{ $th }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($baris as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    @foreach ($kolom as $kunci => $namaKolom)
                        @if ($kunci !== 'No')
                            <td>
                                @if ($kunci === 'nim')
                                    <a href="{{ route('mahasiswa.show', $item['nim']) }}">{{ $item[$kunci] }}</a>
                                @else
                                    {{ $item[$kunci] ?? '-' }}
                                @endif
                            </td>
                        @endif
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($kolom) }}" class="text-center py-4 text-muted">
                        Tidak ada data tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>