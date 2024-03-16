<?php

namespace Tests\Feature;

use App\Mail\PeminjamanDisetujui;
use App\Models\PeminjamanBuku;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class NotifyTest extends TestCase
{
    public function test_notify()
    {
        // Membuat instansiasi PeminjamanBuku untuk diuji
        $peminjaman = PeminjamanBuku::factory()->create();

        // Mendefinisikan tanggal deadline untuk pengujian
        $deadline = Carbon::now()->addDays(7)->isoFormat('D MMMM YYYY');

        // Membuat instance dari email notification
        $notification = new PeminjamanDisetujui($peminjaman);

        // Memeriksa apakah properti peminjaman dan deadline diatur dengan benar
        $this->assertEquals($peminjaman, $notification->peminjaman);
        $this->assertEquals($deadline, $notification->deadline);

        // Mengirimkan notifikasi email dan memeriksa apakah tidak ada exception yang terjadi
        Mail::fake();
        Mail::to('test@example.com')->send($notification);
        Mail::assertSent(PeminjamanDisetujui::class, function ($mail) use ($peminjaman, $deadline) {
            return $mail->peminjaman->id === $peminjaman->id &&
                $mail->deadline === $deadline;
        });
    }
}
