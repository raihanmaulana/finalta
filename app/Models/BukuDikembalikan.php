<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuDikembalikan extends Model
{
    protected $table = 'buku_dikembalikan';
    protected $primaryKey = 'id';
    protected $fillable = ['id_anggota', 'id_buku', 'added_by'];
}
