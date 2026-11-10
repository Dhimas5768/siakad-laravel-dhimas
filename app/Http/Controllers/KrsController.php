<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf; 
class KrsController extends Controller
{
    public function index()
    {
        return view('krs.index');
    }

    public function data()
    {
        $query = Krs::with('mahasiswa');
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('nim', fn($row) => $row->mahasiswa->nim ?? '-')
            ->addColumn('nama_mahasiswa', fn($row) => $row->mahasiswa->nama ?? '-')
            ->addColumn('aksi', fn($row) => view('krs._aksi', compact('row'))->render())
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::orderBy('nama')->get();
        $matakuliahs = MataKuliah::orderBy('nama_mk')->get();
        return view('krs.create', compact('mahasiswas', 'matakuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'semester' => 'required|string',
            'matakuliah_ids' => 'required|array|min:1',
            'matakuliah_ids.*' => 'exists:mata_kuliah,id',
        ]);

        $krs = Krs::firstOrCreate([
            'mahasiswa_id' => $request->mahasiswa_id,
            'semester' => $request->semester,
            'tahun_akademik' => '2025/2026',
        ]);

        foreach ($request->matakuliah_ids as $mkId) {
            $krs->details()->firstOrCreate(['mata_kuliah_id' => $mkId]);
        }

        return redirect()->route('krs.index')->with('success', 'KRS berhasil disimpan.');
    }

    public function destroy($id)
    {
        $krs = Krs::findOrFail($id);
        $krs->delete();
        
        return redirect()->route('krs.index')->with('success', 'Data KRS berhasil dihapus.');
    }

    public function cetakPdf(Krs $krs)
    {
        $krs->load('mahasiswa', 'details.matakuliah');
        
        $pdf = Pdf::loadView('krs.pdf', compact('krs')); 
        return $pdf->download('KRS-' . ($krs->mahasiswa->nim ?? 'mahasiswa') . '.pdf');
    }
}