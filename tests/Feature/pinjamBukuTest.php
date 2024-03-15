<?php

use App\Models\AnggotaPerpustakaan;
use App\Models\Buku;
use App\Models\PeminjamanBuku;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PinjamBukuTest extends TestCase
{
    use DatabaseTransactions;

    public function test_pinjamBuku()
    {
        // Persiapan data
        $anggota = AnggotaPerpustakaan::factory()->create();
        $buku = Buku::factory()->create(['tersedia' => 1, 'kondisi' => 1]);
        $data = [
            'nomor_anggota' => $anggota->nomor_anggota,
            'isbn' => $buku->isbn,
        ];

        // Memanggil route untuk meminjam buku
        $response = $this->postJson('/offline', $data);

        // Memeriksa respons
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Memeriksa bahwa peminjaman berhasil dibuat
        $this->assertDatabaseHas('peminjaman_buku', [
            'id_buku' => $buku->id_buku,
            'id_anggota' => $anggota->id_anggota,
            'isbn' => $buku->isbn,
            'status' => 1,
        ]);

        // Memeriksa bahwa stok buku berkurang
        $this->assertEquals($buku->fresh()->tersedia, 0);
    }
}
