<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li>
                <a href="{{ URL::route('home') }}">
                    <i class="menu-icon icon-home"></i>Cari Buku
                </a>
            </li>
            <li>
                <a href="{{ URL::route('all-books') }}">
                    <i class="menu-icon icon-th-list"></i>Peminjaman Buku
                </a>
            </li>
            <li>
                <a href="{{ URL::route('list-anggota') }}">
                    <i class="menu-icon icon-group"></i>Status Peminjaman
                </a>
            </li>

        </ul>

        <ul class="widget widget-menu unstyled">
            <li><a href="{{ URL::route('account-sign-out') }}"><i class="menu-icon icon-wrench"></i>Logout </a></li>
        </ul>
    </div>
</div>
