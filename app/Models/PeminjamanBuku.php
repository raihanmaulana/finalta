<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class PeminjamanBuku extends Model
// {
//     use HasFactory;
// }
class PeminjamanBuku extends Model
{
    protected $table = 'peminjaman_buku'; // Nama tabel dalam database

    protected $fillable = [
        'id',
        'id_buku', // ID buku yang dipinjam
        'id_anggota', // ID anggota yang melakukan peminjaman
        'status', // Status peminjaman (misalnya: menunggu, disetujui, ditolak)
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\AnggotaPerpustakaan');
    }

    public function books()
    {
        return $this->belongsTo('App\Models\Buku');
    }

    // PeminjamanBuku.php

    public function anggota()
    {
        return $this->belongsTo(AnggotaPerpustakaan::class, 'id_anggota');
    }


    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
