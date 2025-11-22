<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EkycRegistration extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nik',
        'name',
        'tanggal_lahir',
        'alamat',
        'file_ktp',
        'file_kk',
        'file_ijazah',
        'file_selfie',
        'asal_sd',
        'asal_smp',
        'asal_sma',
        'alamatDomisili',
        'provinsi',
        'kota',
        'kecamatan',
        'kode_pos',
        'nama_ibu_kandung',
        'referensi_sumber',
        'status',
    ];

    // relasi ke table user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

