<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li>
                <a href="{{ URL::route('anggota.dashboard') }}">
                    <i class="menu-icon icon-home"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="{{ URL::route('anggota.peminjaman.form') }}">
                    <i class="menu-icon icon-book"></i>Peminjaman Buku
                </a>
            </li>
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
