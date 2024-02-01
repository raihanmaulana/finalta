<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li>
                <a href="{{ URL::route('anggota.cari-buku') }}">
                    <i class="menu-icon icon-home"></i>Cari Buku
                </a>
            </li>
            {{-- <li>
                <a href="{{ URL::route('anggota.peminjaman.form') }}">
                    <i class="menu-icon icon-th-list"></i>Form Peminjaman Buku
                </a>
            </li> --}}
            <li>
                <a href="{{ URL::route('anggota.list') }}">
                    <i class="menu-icon icon-group"></i>Status Peminjaman
                </a>
            </li>
        </ul>

        <ul class="widget widget-menu unstyled">
            <li><a href="{{ URL::route('anggota.logout') }}"><i class="menu-icon icon-wrench"></i>Logout </a></li>
        </ul>
    </div>
</div>
