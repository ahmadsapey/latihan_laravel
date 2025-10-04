<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas; // Pastikan Anda memiliki model Kelas
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        // $data = Mahasiswa::all();
        // return view('mahasiswa.index', compact('data'));

        $data = Mahasiswa::with('kelas')->get();
        $kelas = Kelas::all(); // Pastikan Anda memiliki model Kelas
        return view('mahasiswa.index', compact('data', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'kelas_id' => 'nullable|exists:kelas,id', // Validasi untuk kelas_id
        ]);
        Mahasiswa::create(['nama' => $request->nama,
        'nim' => $request->nim,
        'kelas_id' => $request->kelas_id,
    ]);
        return redirect()->back()->with('success', 'Data mahasiswa berhasil ditambahkan.');
        }

        // edit
    public function edit($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $id,
        ]);

        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update($request->only('nama', 'nim'));
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    // delete
    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
