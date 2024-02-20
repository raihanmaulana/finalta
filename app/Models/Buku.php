<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'id_buku', 'isbn', 'judul_buku',
        'penerbit', 'pengarang', 'tahun_terbit', 'kategori_id', 'added_by',
        'stok', 'image', 'status_buku', 'tersedia', 'kondisi', 'tautan_buku', 'deskripsi'
    ];

    public $timestamps = true;

    protected $table = 'buku';
    protected $primaryKey = 'id_buku';

    protected $hidden = array();

    public function getImagePathAttribute($value)
    {
        return $value;
    }
    public function issues()
    {
        return $this::count();
    }
    public function hitungTersedia()
    {
        // Menghitung jumlah buku yang dapat dipinjam (stok dikurangi jumlah buku yang dipinjam)
        $totalBorrowed = PeminjamanBuku::where('id_buku', '=', $this->id_buku)->where('status', '=', 1)->count();
        $tersedia = max(0, $this->stok - $totalBorrowed);

        // Update nilai available di model dan simpan
        $this->tersedia = $tersedia;
        $this->save();

        return $tersedia;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
