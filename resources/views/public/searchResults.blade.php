@foreach ($books as $book)
<div class="col-6 col-md-4 col-lg-2 col-xl-2" data-aos="zoom-in-up">
    <div class="card text-center" style="width: 170px;">
        <img src="{{ $book->image ? asset('storage/' . $book->image) : 'img/130x190.png' }}" class="card-img-top mx-auto px-2 pt-2" style="width:148px; height:210px;" alt="Book Image" data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id_buku }}">
        <div class="card-body px-2 pt-1 pb-2">
            <p class="card-title" style="max-height: 20px; overflow: hidden;">
                {{ $book->judul_buku }}
            </p>
            <button class="btn btn-dark" style="font-size: 12px; padding: 5px 10px;" data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id_buku }}" onclick="showBookDetails('{{ $book->id_buku }}')">Detail</button>
        </div>
    </div>
</div>
<div class="modal fade" id="detailModal{{ $book->id_buku }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $book->judul_buku }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Informasi buku -->
                <p>ISBN: {{ $book->isbn }}</p>
                <p>Penerbit: {{ $book->penerbit }}</p>
                <p>Pengarang: {{ $book->pengarang }}</p>
                <p>Tahun Terbit: {{ $book->tahun_terbit }}</p>
                <p>Kategori : {{ $book->kategori->kategori }}</p>
                <p>Deskripsi : {{ $book->deskripsi }}</p>
                @if ($book->tautan_buku)
                <p>Tautan Buku: <a href="{{ $book->tautan_buku }}" target="_blank">{{ $book->tautan_buku }}</a></p>
                @else
                <p>Tautan Buku: " Tidak Tersedia "</p>
                @endif

                <!-- Gambar buku -->
                @if ($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="Gambar Buku" style="max-width: 100px; max-height: 100px;">
                @else
                No Image
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach