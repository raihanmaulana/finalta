<h2>Hasil Pencarian</h2>

@if ($result->isEmpty())
<p>Tidak ada hasil yang ditemukan.</p>
@else
<ul>
    @foreach ($result as $book)
    <li>{{ $book->judul_buku }} - {{ $book->pengarang }} ({{ $book->kategori }})</li>
    @endforeach
</ul>
@endif