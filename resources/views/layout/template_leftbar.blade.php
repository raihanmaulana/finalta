<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li>
                <a href="{{ URL::route('home') }}">
                    <i class="menu-icon icon-home"></i>Home
                </a>
            </li>
            <li>
                <a href="{{ URL::route('all-books') }}">
                    <i class="menu-icon icon-book"></i>Kelola Katalog
                </a>
            </li>
            <li>
                <a href="{{ URL::route('list-anggota') }}">
                    <i class="menu-icon icon-group"></i>Kelola Anggota
                </a>
            </li>
            <li>
                <a href="{{ URL::route('admin.peminjaman.daftar') }}">
                    <i class="menu-icon icon-filter"></i> Konfirmasi Peminjaman
                </a>
            </li>
            <li>
                <a href="{{ URL::route('admin.buku-dipinjam') }}">
                    <i class="menu-icon icon-list-ul"></i>Daftar Peminjam
                </a>
            </li>
            <li>
                <a href="{{ URL::route('admin.buku-dikembalikan') }}">
                    <i class="menu-icon icon-signout"></i>Riwayat Peminjaman
                </a>
            </li>
            <li>
                <a href="{{ URL::route('bukutamu.view') }}">
                    <i class="menu-icon icon-list-ul"></i>Buku Tamu
                </a>
            </li>
            <li>
                <a href="{{ URL::route('galeri.create') }}">
                    <i class="menu-icon icon-list-ul"></i>Tambah Gambar Galeri
                </a>
            </li>

        </ul>
        {{--
        <ul class="widget widget-menu unstyled">
            <li><a href="{{ URL::route('account-sign-out') }}"><i class="menu-icon icon-wrench"></i>Logout </a></li>
        </ul> --}}
    </div>
</div>