<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak KRS - {{ $krs->mahasiswa->nim }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2, .header h3 { margin: 2px 0; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 4px 0; }
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .data-table th, .data-table td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        .data-table th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>POLITEKNIK NEGERI PONTIANAK</h2>
        <h3>KARTU RENCANA STUDI (KRS)</h3>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%"><strong>NIM</strong></td>
            <td width="35%">: {{ $krs->mahasiswa->nim }}</td>
            <td width="15%"><strong>Semester</strong></td>
            <td width="35%">: {{ $krs->semester }}</td>
        </tr>
        <tr>
            <td><strong>Nama</strong></td>
            <td>: {{ $krs->mahasiswa->nama }}</td>
            <td><strong>Program Studi</strong></td>
            <td>: {{ $krs->mahasiswa->program_studi ?? '-' }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="8%" class="text-center">No.</th>
                <th width="15%">Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th width="10%" class="text-center">SKS</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSks = 0; @endphp
            @foreach($krs->details as $index => $detail)
                @php $totalSks += $detail->matakuliah->sks; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $detail->matakuliah->kode_mk }}</td>
                    <td>{{ $detail->matakuliah->nama_mk }}</td>
                    <td class="text-center">{{ $detail->matakuliah->sks }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>Total SKS:</strong></td>
                <td class="text-center"><strong>{{ $totalSks }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <table width="100%">
        <tr>
            <td width="70%"></td>
            <td width="30%" class="text-center">
                Pontianak, {{ date('d-m-Y') }}<br>
                Mahasiswa,
                <br><br><br><br>
                <strong>{{ $krs->mahasiswa->nama }}</strong>
            </td>
        </tr>
    </table>
</body>
</html>