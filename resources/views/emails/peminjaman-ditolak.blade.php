@component('mail::message')
# Pemberitahuan

Permintaan peminjaman buku Anda ditolak.
Mohon Perhatikan kembali syarat dan ketentuan peminjaman buku.

Buku yang telah ditolak:
- Judul: {{ $peminjaman->buku->judul_buku }}
- Penulis: {{ $peminjaman->buku->pengarang }}
- Penerbit: {{ $peminjaman->buku->penerbit }}

Terima kasih telah menggunakan layanan kami.

Salam,<br>
{{ config('app.name') }}
@endcomponent