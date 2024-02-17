<?php

namespace App\Mail;

use App\Models\PeminjamanBuku;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class PeminjamanDisetujui extends Mailable
{
    use Queueable, SerializesModels;

    public $peminjaman;
    public $deadline;

    /**
     * Create a new message instance.
     *
     * @param PeminjamanBuku $peminjaman
     * @return void
     */
    public function __construct(PeminjamanBuku $peminjaman)
    {
        $this->peminjaman = $peminjaman;
        // Hitung tanggal deadline pengembalian (7 hari dari sekarang)
        $this->deadline = Carbon::now()->addDays(7)->isoFormat('D MMMM YYYY');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.peminjaman-disetujui')
            ->subject('Pemberitahuan: Permintaan Peminjaman Buku Disetujui');
    }
}
