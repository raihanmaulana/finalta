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
                    <i class="menu-icon icon-th-list"></i>Kelola Katalog
                </a>
            </li>
            <li>
                <a href="{{ URL::route('registered-students') }}">
                    <i class="menu-icon icon-group"></i>Kelola Anggota
                </a>
            </li>
            <li>
                <a href="{{ URL::route('students-for-approval') }}">
                    <i class="menu-icon icon-filter"></i> Konfirmasi Peminjaman
                </a>
            </li>
            <li>
                <a href="{{ URL::route('currently-issued') }}">
                    <i class="menu-icon icon-list-ul"></i>List Peminjam
                </a>
            </li>
            <li>
                <a href="{{ URL::route('issue-return') }}">
                    <i class="menu-icon icon-signout"></i>Pengembalian Buku
                </a>
            </li>



            {{-- <li>
                <a href="{{ URL::route('add-book-category') }}">
                    <i class="menu-icon icon-folder-open-alt"></i>Add Book Category
                </a>
            </li>
            <li>
                <a href="{{ URL::route('add-books') }}">
                    <i class="menu-icon icon-folder-open-alt"></i>Add Books
                </a>
            </li>
            <li>
                <a href="{{ URL::route('settings') }}">
                    <i class="menu-icon icon-cog"></i>Add Settings
                </a>
            </li> --}}


        </ul>

        <ul class="widget widget-menu unstyled">
            <li><a href="{{ URL::route('account-sign-out') }}"><i class="menu-icon icon-wrench"></i>Logout </a></li>
        </ul>
    </div>
</div>
