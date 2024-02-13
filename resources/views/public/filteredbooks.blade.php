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
@endforeach