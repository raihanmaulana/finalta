<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuDikembalikan extends Model
{
    protected $table = 'buku_dikembalikan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_anggota', 'id_buku', 'added_by', 'nomor_anggota'];


    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanBuku::class, 'id_peminjaman', 'id_peminjaman');
    }
    public function anggota()
    {
        return $this->belongsTo(AnggotaPerpustakaan::class, 'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public static function createFromPeminjamanBuku($peminjaman, $addedBy)
    {
        return self::create([
            'id_peminjaman' => $peminjaman->id_peminjaman,
            'id_anggota' => $peminjaman->id_anggota,
            'id_buku' => $peminjaman->id_buku, // Menambahkan nilai id_anggota dari PeminjamanBuku
            'added_by' => $addedBy,
            'tanggal_peminjaman' => $peminjaman->tanggal_peminjaman,
            'tanggal_pengembalian' => now(),
        ]);
    }
}
