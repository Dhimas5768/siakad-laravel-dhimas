<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Http\Requests\MahasiswaRequest;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.index');
    }

    public function data()
    {
        $query = Mahasiswa::query();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return view('mahasiswa._aksi', compact('row'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create()
    {
        $mahasiswa = new Mahasiswa();
        return view('mahasiswa.create', compact('mahasiswa'));
    }

    public function store(MahasiswaRequest $request)
    {
        Mahasiswa::create($request->validated());
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update($request->validated());
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return response()->json(['message' => 'Data mahasiswa berhasil dihapus.']);
    }
}