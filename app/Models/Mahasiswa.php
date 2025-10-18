<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Mahasiswa extends Model
{
    use HasFactory;

    // Nama tabel (opsional)
    protected $table = 'mahasiswa';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'nama',
        'nim',
        'alamat',
        'kelas_id',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
