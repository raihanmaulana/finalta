<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PeminjamanBuku;
use App\Models\Buku;
use App\Mail\PeminjamanDitolak;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class tolakPeminjamanTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tolakPeminjaman()
    {

        // Membuat pengguna untuk digunakan dalam pengujian
        $user = User::factory()->create();
        $this->actingAs($user);

        Mail::fake();

        // Membuat peminjaman buku dengan status 0
        $peminjaman = PeminjamanBuku::factory()->create(['status' => 0]);

        // Menjalankan fungsi tolakPeminjaman untuk peminjaman yang dibuat
        $response = $this->put("/peminjaman/{$peminjaman->id}/tolakPeminjaman");

        // Memeriksa bahwa respons adalah redirect
        $response->assertStatus(302);

        // Memeriksa bahwa peminjaman berhasil dihapus dari database
        $this->assertDatabaseMissing('peminjaman_buku', ['id' => $peminjaman->id]);

        // Memeriksa bahwa email pemberitahuan pengembalian ditolak dikirim
        Mail::assertSent(PeminjamanDitolak::class, function ($mail) use ($peminjaman) {
            return $mail->hasTo($peminjaman->anggota->email);
        });

        // Memeriksa bahwa sesi flash memiliki pesan yang sesuai
        $response->assertSessionHas('success', 'Permintaan peminjaman ditolak.');
    }
}
