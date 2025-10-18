<?php

namespace Database\Seeders\UTS;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::firstOrCreate(['nama_kelas' => 'A']);
        Kelas::firstOrCreate(['nama_kelas' => 'B']);
        Kelas::firstOrCreate(['nama_kelas' => 'C']);
        Kelas::firstOrCreate(['nama_kelas' => 'D']);
    }
}
