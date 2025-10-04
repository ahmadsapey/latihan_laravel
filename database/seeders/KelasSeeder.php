<?php

namespace Database\Seeders;

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
        //
        kelas::create(['nama_kelas' => 'A']);
        kelas::create(['nama_kelas' => 'B']);
        kelas::create(['nama_kelas' => 'C']);
    }
}
