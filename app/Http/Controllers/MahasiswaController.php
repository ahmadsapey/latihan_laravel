<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::with('kelas')->orderBy('id', 'desc')->paginate(15);
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('mahasiswa.index', compact('data', 'kelas'));
    }

    public function create()
    {
        // The create form is included in the `mahasiswa.index` view, so render that
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $data = Mahasiswa::with('kelas')->orderBy('id', 'desc')->paginate(15);
        return view('mahasiswa.index', compact('data', 'kelas'));
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
        // No separate show view exists; redirect to index instead
        return redirect()->route('mahasiswa.index');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => "required|string|max:50|unique:mahasiswa,nim,{$id}",
            'alamat' => 'nullable|string|max:500',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $mahasiswa->update($data);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $m = Mahasiswa::findOrFail($id);
        $m->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }

        
}

