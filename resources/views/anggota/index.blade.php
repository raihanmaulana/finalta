<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="shortcut icon" href="">
    <link rel="icon" href="{{ asset('css/images/logo.png') }}" type="image/x-icon">
    <link rel="canonical" href="" />

    <title>Perpusakaan SMA Negeri 1 Tunjungan</title>

    <link type="text/css" href="{{ asset('static/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('static/bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('static/css/theme.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('static/images/icons/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @include('common.script_top')


</head>

<body>
    <style>
        @media (max-width: 990px) {
            .hide-on-small {
                display: none;
            }
        }

        .module-head {
            background-color: #025e9bf0;
            color: #ffffff;

            text-transform: uppercase;
            font-style: bold;
        }

        .module-head h3 {
            color: #ffffff;
        }

        .module-head h2 {
            color: #ffffff;
            text-align: center;
        }

        .module-body h3 {
            color: #555555;
        }

        .text {
            text-align: center;
        }

        .widget-menu {
            background: #025E9B;
            color: #ffffff;
            font-style: bold;
        }

        .navbar-inner {
            background: #025E9B;
            color: #000000;
        }

        .table th,
        .table td {
            font-size: 12px;
            /* Atur ukuran font yang diinginkan */
        }

        .rounded-corner {
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
    </style>

    @include('layout.template_anggota_navbar')

    <div class="wrapper">
        <div class="container">
            <div class="row">

                @include('layout.template_anggota_leftbar')

                <div class="span9">

                    @include('account.message')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('layout.template_footer')


    <script src="{{ asset('static/scripts/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('static/scripts/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('static/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('static/scripts/underscore-min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('static/custom/js/script.common.js') }}" type="text/javascript"></script>

    @include('common.script_bottom')

    <script type="text/template" id="alert_box">
        @include('underscore.alert_box')

</script>

    <script>
        $(document).ready(function() {
            $("input").attr("autocomplete", "off");
        });
    </script>

</body>

</html>
