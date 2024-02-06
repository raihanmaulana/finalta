@section('customcss')
<!----======== CSS ======== -->
<link rel="stylesheet" href="{{asset('css/utama/dashboard.css')}}" />

<head>
    <script src="https://kit.fontawesome.com/d94b3a5809.js" crossorigin="anonymous"></script>
</head>

@endsection

<div class="footer" style="position: fixed; bottom: 0; width: 100%; background-color: #f8f9fa; text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-md-start">
                <!-- Identitas -->
                <b class="copyright">&copy; {{ date('Y') }} - Perpustakaan SMA Negeri 1 Tunjungan </b>
                All rights reserved.
            </div>
            <div class="social-icons1">
                <a href="https://web.facebook.com/sman1tunjungan" title="Facebook"><i
                        class="fa-brands fa-facebook fa-2xl" style="color: #0f7dd2;"></i></a>
                <a href="https://twitter.com" title="Twitter"><i class="fa-brands fa-x-twitter fa-2xl"
                        style="color: #101010;"></i></a>
                <a href="https://www.instagram.com" title="Instagram"><i class="fab fa-instagram fa-2xl"
                        style="color: #0f7dd2;"></i></a>
                <a href="https://www.youtube.com" title="Youtube"><i class="fa-brands fa-youtube fa-2xl"
                        style="color: #ff0000;"></i></a>
            </div>
        </div>
    </div>
</div>