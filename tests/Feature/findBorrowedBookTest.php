<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AnggotaPerpustakaan;
use App\Models\User;
use App\Models\Buku;
use App\Models\PeminjamanBuku;
use Tests\TestCase;

class findBorrowedBookTest extends TestCase
{
    use DatabaseTransactions;
    public function test_findBorrowedBook()
    {
        // Membuat pengguna untuk simulasi autentikasi
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat data anggota perpustakaan
        $anggota = AnggotaPerpustakaan::factory()->create();

        // Menentukan ISBN untuk buku yang dipinjam
        $isbn = "9780439708180"; // ISBN dari buku yang dipinjam

        // Membuat data buku yang dipinjam
        PeminjamanBuku::factory()->create([
            'isbn' => $isbn,
            'id_anggota' => $anggota->id_anggota,
            'status' => 1, // Status peminjaman aktif
        ]);

        // Memanggil rute untuk mencari buku yang dipinjam
        $response = $this->getJson("/find-borrowed-book/{$isbn}");

        // Memastikan bahwa respons memiliki status 200 (OK)
        $response->assertStatus(200);

        // Memeriksa bahwa respons berisi data buku yang dipinjam sesuai dengan ISBN yang dicari
        $response->assertJsonFragment([
            'isbn' => $isbn
        ]);

        // Memeriksa bahwa respons berisi atribut yang diharapkan untuk setiap buku yang dipinjam
        $response->assertJsonStructure([
            '*' => [
                'isbn',
                'nomor_anggota',
                'nama_anggota',
                'status'
            ]
        ]);
    }
}
