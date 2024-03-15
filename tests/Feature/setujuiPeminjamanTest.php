<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\PeminjamanBuku;
use App\Models\Buku;
use App\Mail\PeminjamanDisetujui;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class setujuiPeminjamanTest extends TestCase
{
    use DatabaseTransactions;

    public function test_setujuiPeminjaman()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // Persiapan data
        $peminjaman = PeminjamanBuku::factory()->create(['status' => 0]); // Ubah status menjadi 0
        $buku = Buku::factory()->create(['tersedia' => 1]);

        // Memanggil route untuk menyetujui peminjaman
        $response = $this->put("/peminjaman/{$peminjaman->id}/setujuiPeminjaman");

        // Memeriksa bahwa status response adalah 302 (redirect)
        $response->assertStatus(302);

        // Memeriksa bahwa peminjaman telah disetujui dengan status 1
        $this->assertEquals(1, $peminjaman->fresh()->status);

        // Memeriksa bahwa buku yang dipinjam memiliki stok yang berkurang
        $this->assertEquals($buku->tersedia - 1, $buku->fresh()->tersedia);

        // Memeriksa bahwa email peminjaman disetujui dikirim
        Mail::assertSent(PeminjamanDisetujui::class, function ($mail) use ($peminjaman) {
            return $mail->hasTo($peminjaman->anggota->email);
        });

        // Memeriksa bahwa setelah pengiriman email, sesi flash success tersedia
        $response->assertSessionHas('success', 'Permintaan peminjaman disetujui.');
    }
}
