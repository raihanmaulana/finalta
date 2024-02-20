<?php

namespace App\Mail;

use App\Models\PeminjamanBuku;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeminjamanDitolak extends Mailable
{
    use Queueable, SerializesModels;

    public $peminjaman;

    /**
     * Create a new message instance.
     *
     * @param PeminjamanBuku $peminjaman
     * @return void
     */
    public function __construct(PeminjamanBuku $peminjaman)
    {
        $this->peminjaman = $peminjaman;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.peminjaman-ditolak')
            ->subject('Pemberitahuan: Permintaan Peminjaman Buku Ditolak');
    }
}
