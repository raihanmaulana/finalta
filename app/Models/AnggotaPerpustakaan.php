<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AnggotaPerpustakaan extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'anggota_perpustakaan';
    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'nama_anggota',
        'nomor_anggota',
        'username',
        'nomor_hp',
        'email',
        'jurusan',
        'kelas',
        'password',
        'gambar'
        // Tambahkan fillable lain jika diperlukan
    ];

    // protected $fillable = [
    //     'username', 'password',
    // ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function peminjaman()
    {
        return $this->hasMany(PeminjamanBuku::class, 'id_anggota');
    }

    public function verifikasiAnggota()
    {
        return $this->belongsTo(VerifikasiAnggota::class, 'nomor_anggota', 'nomor_anggota');
    }
}
