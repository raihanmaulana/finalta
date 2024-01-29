<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuDikembalikan extends Model
{
    protected $table = 'buku_dikembalikan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_anggota', 'id_buku', 'added_by', 'nomor_anggota'];


    public function peminjamanBuku()
    {
        return $this->belongsTo(PeminjamanBuku::class, 'id');
    }

    public function anggota()
    {
        return $this->belongsTo(AnggotaPerpustakaan::class, 'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public static function createFromPeminjamanBuku($peminjamanBuku, $addedBy)
    {
        return self::create([
            'id_anggota' => $peminjamanBuku->id_anggota,
            'id_buku' => $peminjamanBuku->id_buku,
            'added_by' => $addedBy,
            'nomor_anggota' => $peminjamanBuku->anggota->nomor_anggota, // Sesuaikan dengan relasi
            'tanggal_peminjaman' => $peminjamanBuku->created_at, // Tambahkan kolom waktu peminjaman
        ]);
    }
}
