@section('customcss')
<!----======== CSS ======== -->
<link rel="stylesheet" href="{{asset('css/utama/footer.css')}}" />

<head>
    <script src="https://kit.fontawesome.com/d94b3a5809.js" crossorigin="anonymous"></script>
</head>

@endsection

<div class="footer"
    style=" width: 100%; background-color: #ffff; text-align: center; color: #999; padding: 30px 0 60px;">
    <div class="container">
        <div class="row">
            <div class="">
                <!-- Identitas -->
                <b class="copyright">&copy; {{ date('Y') }} - Perpustakaan SMA Negeri 1 Tunjungan </b>
                All rights reserved.
            </div>
        </div>
    </div>
</div>