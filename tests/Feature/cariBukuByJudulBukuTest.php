<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Buku;
use App\Models\User;

class CariBukuByJudulBukuTest extends TestCase
{
    use DatabaseTransactions;

    public function test_cariBukuByJudulBuku()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $buku = Buku::factory()->create([
            'judul_buku' => 'Harry Potter', // Judul buku yang akan dicari
        ]);

        // Panggil route untuk mencari buku berdasarkan judul
        $response = $this->getJson("/search-books/Harry Potter");

        // Periksa bahwa respons memiliki status 200 (OK)
        $response->assertStatus(200);

        // Periksa bahwa respons berisi data buku yang sesuai dengan judul pencarian
        $response->assertJsonFragment([
            'judul_buku' => 'Harry Potter'
        ]);

        // Periksa bahwa respons berisi atribut yang diharapkan untuk setiap buku
        $response->assertJsonStructure([
            '*' => [
                'id_buku',
                'isbn',
                'judul_buku',
                'pengarang',
                'tahun_terbit',
                'kategori',
                'stok',
                'tersedia'
            ]
        ]);
    }
}
