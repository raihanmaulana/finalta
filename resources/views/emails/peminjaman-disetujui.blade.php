@component('mail::message')
# Pemberitahuan

Permintaan peminjaman buku Anda telah disetujui.

Buku yang telah disetujui:
- Judul: {{ $peminjaman->buku->judul_buku }}
- Penulis: {{ $peminjaman->buku->pengarang }}
- Penerbit: {{ $peminjaman->buku->penerbit }}
- Deadline Pengembalian: {{ $deadline }}

Terima kasih telah menggunakan layanan kami.

Salam,<br>
{{ config('app.name') }}
@endcomponent