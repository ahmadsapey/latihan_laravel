<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('kelas')->orderBy('id', 'desc')->paginate(15);
        return view('UTS_Laravel.index', compact('mahasiswas'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('UTS_Laravel.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:mahasiswa,nim',
            'alamat' => 'nullable|string|max:500',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        Mahasiswa::create($data);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function show($id)
    {
        $m = Mahasiswa::with('kelas')->findOrFail($id);
        return view('UTS_Laravel.show', ['m' => $m]);
    }

    public function edit($id)
    {
        $m = Mahasiswa::findOrFail($id);
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('UTS_Laravel.edit', compact('m', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $m = Mahasiswa::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => "required|string|max:50|unique:mahasiswa,nim,{$id}",
            'alamat' => 'nullable|string|max:500',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $m->update($data);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $m = Mahasiswa::findOrFail($id);
        $m->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }

        
}

