<?php

namespace App\Models;

use App\Models\AnggotaPerpustakaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTamuAnggota extends Model
{
    use HasFactory;

    protected $table = 'bukutamu_anggota';

    protected $fillable = ['nomor_anggota', 'nama_anggota', 'email', 'kelas'];


    // Jika Anda memiliki relasi dengan model AnggotaPerpustakaan, Anda dapat menambahkannya di sini
    public function anggota()
    {
        return $this->belongsTo(AnggotaPerpustakaan::class, 'nomor_anggota', 'nama_anggota', 'email');
    }
}
