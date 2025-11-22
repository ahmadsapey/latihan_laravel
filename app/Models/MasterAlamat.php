<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAlamat extends Model
{
    use HasFactory;

    protected $table = 'master_alamat';
    protected $fillable = ['provinsi', 'kota', 'kecamatan', 'kode_pos'];
}
