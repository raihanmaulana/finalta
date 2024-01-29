<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['id_buku', 'nomor_buku', 'judul_buku', 'penerbit', 'pengarang', 'tahun_terbit', 'kategori_id', 'added_by', 'stok', 'image_path', 'status_buku'];

    public $timestamps = true;

    protected $table = 'buku';
    protected $primaryKey = 'id_buku';

    protected $hidden = array();

    public function getImagePathAttribute($value)
    {
        // Any custom logic for getting the image path
        return $value;
    }
    public function issues()
    {
        return $this::count();
    }
}
