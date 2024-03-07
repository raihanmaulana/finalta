<?php

use Tests\TestCase;
use App\Models\Buku;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class BukuTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index()
    {
        $response = $this->get('/all-books');

        $response->assertStatus(200);
    }
    public function test_create()
    {
        $response = $this->post('/kelola-buku', [
            // Kirim data buku yang ingin disimpan
            'isbn' => '123456789',
            'judul_buku' => 'Judul Buku',
            // Isi dengan data buku yang lain
        ]);

        $response->assertStatus(302); // Redirect setelah penyimpanan
        $response->assertRedirect('/all-books'); // Cek apakah mengarah ke halaman semua buku
    }

    public function test_store()
    {
        $response = $this->post('/kelola-buku', [
            // Kirim data buku yang ingin disimpan
            'isbn' => '123456789',
            'judul_buku' => 'Judul Buku',
            // Isi dengan data buku yang lain
        ]);

        $response->assertStatus(302); // Redirect setelah penyimpanan
        $response->assertRedirect('/all-books'); // Cek apakah mengarah ke halaman semua buku
    }

    public function test_update()
    {
        $book = Buku::factory()->create();

        $response = $this->put('/kelola-buku/' . $book->id, [
            // Kirim data buku yang ingin diupdate
            'judul_buku' => 'Judul Buku yang Diperbarui',
            // Isi dengan data buku yang lain yang ingin diupdate
        ]);

        $response->assertStatus(302); // Redirect setelah update
        $response->assertRedirect('/all-books'); // Cek apakah mengarah ke halaman semua buku
    }
}
