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
    protected $table = 'peminjaman'; // Nama tabel dalam database

    protected $fillable = [
        'id',
        'book_id', // ID buku yang dipinjam
        'username', // ID anggota yang melakukan peminjaman
        'status', // Status peminjaman (misalnya: menunggu, disetujui, ditolak)
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\AnggotaPerpustakaan');
    }

    public function books()
    {
        return $this->belongsTo('App\Models\Books');
    }
}
