<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=KelasSeeder
     */
    public function run(): void
    {
        Kelas::firstOrCreate(['nama_kelas' => 'A']);
        Kelas::firstOrCreate(['nama_kelas' => 'B']);
        Kelas::firstOrCreate(['nama_kelas' => 'C']);
    }
}
