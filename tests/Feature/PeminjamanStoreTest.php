<?php

namespace Tests\Feature;

use App\Models\AnggotaPerpustakaan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Buku;

class PeminjamanStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    public function test_peminjamanStore()
    {

        $user = AnggotaPerpustakaan::factory()->create();
        $this->actingAs($user, 'anggota');

        $buku = Buku::factory()->create([
            'kondisi' => 1,
            'tersedia' => 1,
        ]);

        $response = $this->post('/anggota/peminjaman', [
            'id_buku' => $buku->id_buku,
        ]);

        $response->assertRedirect(route('anggota.list'));
        $response->assertSessionHas('success', 'Permintaan peminjaman berhasil diajukan.');
        $this->assertDatabaseHas('peminjaman_buku', [
            'id_buku' => $buku->id_buku,
            'isbn' => $buku->isbn,
            'status' => 0,
            'id_anggota' => $user->id_anggota,
        ]);
    }
}
