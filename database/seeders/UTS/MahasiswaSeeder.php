<?php

namespace Database\Seeders\UTS;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasA = Kelas::where('nama_kelas', 'A')->first();
        $kelasB = Kelas::where('nama_kelas', 'B')->first();

        Mahasiswa::firstOrCreate(['nim' => '2025001'], [
            'nama' => 'Andi',
            'alamat' => 'Jl. Merdeka 1',
            'kelas_id' => $kelasA ? $kelasA->id : null,
        ]);

        Mahasiswa::firstOrCreate(['nim' => '2025002'], [
            'nama' => 'Budi',
            'alamat' => 'Jl. Merdeka 2',
            'kelas_id' => $kelasB ? $kelasB->id : null,
        ]);
    }
}
