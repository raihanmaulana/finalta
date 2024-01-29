<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container" style="align-items: center; display: flex; justify-content: space-between">

            <a class="brand" href="{{ URL::route('home') }}" style="color:#000000; font-weight:500; margin-right: auto;"><img src="{{ asset('css/images/logo.png') }}" alt="Bootstrap" width="40" height="auto" />
                Perpustakaan SMAN 1 Tunjungan</a>

            <div class="nav-collapse collapse navbar-inverse-collapse">
                <ul class="nav pull-right">
                    <li class="nav-user dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-top: auto;">
                            {{ auth()->user()->username }}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/profile" target="_blank">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ URL::route('account-sign-out') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <a class="btn btn-navbar ml-auto" style="margin-left: auto;" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i></a>
        </div>
    </div>
</div>