<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EkycRegistration extends Model
{
    //
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
    ];

    // relasi ke table user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
