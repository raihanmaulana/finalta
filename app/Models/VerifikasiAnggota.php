<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifikasiAnggota extends Model
{
    protected $table = 'verifikasi_anggota';

    protected $fillable = [
        'nomor_anggota'
    ];

    public function anggotaPerpustakaan()
    {
        return $this->hasOne(AnggotaPerpustakaan::class, 'nomor_anggota', 'nomor_anggota');
    }
}
