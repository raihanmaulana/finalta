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
        Mail::fake();
        // Persiapan data
        $peminjaman = PeminjamanBuku::factory()->create(['status' => 0]); // Ubah status menjadi 0
        $buku = Buku::factory()->create(['tersedia' => 100]);
        $response = $this->put("/peminjaman/{$peminjaman->id}/setujuiPeminjaman");
        $response->assertStatus(302);
        $this->assertEquals(1, $peminjaman->fresh()->status);

        Mail::assertSent(PeminjamanDisetujui::class, function ($mail) use ($peminjaman) {
            return $mail->hasTo($peminjaman->anggota->email);
        });

        $response->assertSessionHas('success', 'Permintaan peminjaman disetujui.');
    }
}
