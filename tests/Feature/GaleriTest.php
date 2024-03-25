<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Galeri;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GaleriTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /** @test */
    public function test_index()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/galeri/kelola');

        $response->assertStatus(200);
    }

    public function test_store()
    {

        $user = User::factory()->create();

        $this->actingAs($user);

        Storage::fake('public');

        $image = UploadedFile::fake()->image('gambar.jpg');

        $response = $this->post('/galeri/store', [
            'judul' => 'Judul Galeri',
            'deskripsi' => 'Deskripsi Galeri',
            'gambar_galeri' => $image,
        ]);

        $response->assertStatus(302); // Redirect setelah penyimpanan
        $response->assertRedirect(route('galeri.create')); // Cek apakah mengarah ke halaman create galeri

        $galeri = Galeri::first();

        $this->assertNotNull($galeri);
        $this->assertEquals('Judul Galeri', $galeri->judul);
        $this->assertEquals('Deskripsi Galeri', $galeri->deskripsi);
        $this->assertNotNull($galeri->gambar_galeri);

        Storage::disk('public')->assertExists($galeri->gambar_galeri);
    }

    public function test_update()
    {
        // Membuat user dan mengautentikasi pengguna
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat galeri dengan menggunakan factory
        $galeri = Galeri::factory()->create();

        // Membuat data untuk pengujian pembaruan
        $updatedJudul = 'Judul Baru';
        $updatedDeskripsi = 'Deskripsi Baru';

        // Mengirim permintaan HTTP POST untuk memperbarui galeri
        $response = $this->put(route('galeri.update', ['id' => $galeri->id]), [
            'judul' => $updatedJudul,
            'deskripsi' => $updatedDeskripsi,
        ]);

        // Memastikan respons sukses (redirect ke halaman manage)
        $response->assertRedirect(route('galeri.manage'));

        // Memeriksa apakah data galeri berhasil diperbarui dalam basis data
        $this->assertDatabaseHas('galeri', [
            'id' => $galeri->id,
            'judul' => $updatedJudul,
            'deskripsi' => $updatedDeskripsi,
        ]);

        // Memeriksa apakah gambar tetap sama jika tidak diubah
        $this->assertEquals($galeri->gambar_galeri, Galeri::find($galeri->id)->gambar_galeri);
    }

    public function test_destroy()
    {
        // Membuat user dan mengautentikasi pengguna
        $user = User::factory()->create();
        $this->actingAs($user);

        // Membuat galeri dengan menggunakan factory
        $galeri = Galeri::factory()->create();

        // Mengirim permintaan HTTP DELETE untuk menghapus galeri
        $response = $this->delete(route('galeri.destroy', ['id' => $galeri->id]));

        // Memastikan respons sukses (redirect ke halaman manage)
        $response->assertRedirect(route('galeri.manage'));

        // Memeriksa apakah galeri telah dihapus dari basis data
        $this->assertDeleted('galeri', [
            'id' => $galeri->id,
        ]);
    }
}
