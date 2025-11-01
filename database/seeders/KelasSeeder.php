<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create(['nama_kelas' => 'A']);
        Kelas::create(['nama_kelas' => 'B']);
        Kelas::create(['nama_kelas' => 'C']);
    }
}
