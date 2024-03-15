<?php

namespace Tests\Feature;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NonaktifkanBukuTest extends TestCase
{
    use DatabaseTransactions;

    public function test_nonaktifkanBuku()
    {

        $user = User::factory()->create();
        $this->actingAs($user);
        // Persiapkan data
        $buku = Buku::factory()->create(['kondisi' => true]);

        // Panggil route untuk mengaktifkan buku
        $response = $this->post(route('books.deactivate', ['id' => $buku->id_buku]));

        // Periksa bahwa respons adalah redirect
        $response->assertStatus(302);
        $response->assertRedirect(route('all-books'));

        // Periksa bahwa kondisi buku telah diubah menjadi true dalam database
        $this->assertEquals(false, $buku->fresh()->kondisi);

        // Periksa bahwa pesan sukses tersedia di sesi flash
        $response->assertSessionHas('success', 'Buku berhasil dinonaktifkan');
    }
}
