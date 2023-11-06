<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = array('id_buku', 'nomor_buku', 'judul_buku', 'penerbit', 'pengarang', 'tahun_terbit', 'kategori_id', 'added_by');

    public $timestamps = false;

    protected $table = 'buku';
    protected $primaryKey = 'id_buku';

    protected $hidden = array();


    public function issues()
    {
        return $this::count();
    }
}
