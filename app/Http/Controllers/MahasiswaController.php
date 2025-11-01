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
        $data = Mahasiswa::with('kelas')->orderBy('id', 'desc')->get();
        $kelas = Kelas::all();
        return view('mahasiswa.index', compact('data', 'kelas'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('mahasiswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:mahasiswa,nim',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        try {
            Mahasiswa::create([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'kelas_id' => $request->kelas_id,
            ]);

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Mahasiswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('mahasiswa.index')
                ->with('error', 'Gagal menambahkan mahasiswa: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $m = Mahasiswa::with('kelas')->findOrFail($id);
        return view('mahasiswa.show', ['m' => $m]);
    }

    public function edit($id)
    {
        $m = Mahasiswa::findOrFail($id);
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('mahasiswa.edit', compact('m', 'kelas'));
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

