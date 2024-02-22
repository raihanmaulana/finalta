<!-- Daftar Kategori -->
<div class="d-flex flex-wrap justify-content-center mt-3" data-aos="zoom-out-up">
    <form id="searchBooks">
        <button type="submit" class="btn btn-outline-dark round m-2">Semua Kategori</button>
    </form>
    @foreach ($kategoriBuku as $kategori)
    <button type="button" class="btn btn-outline-dark round m-2" onclick="filterByCategory('{{ $kategori->kategori }}')">{{ $kategori->kategori }}</button>
    @endforeach
</div>