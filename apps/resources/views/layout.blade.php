<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ico-Crypto</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/info.png') }}">
    @include('meta_seo')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('alertifyjs/css/alertify.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('alertifyjs/css/themes/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @yield('css')
</head>
<body>
<div class="wrapper">

    <div class="header">
        <div class="logo">
            <img src="{{ asset('assets/img/logo-white.png') }}" alt="">
        </div>

        <div class="nav">
            @include('menu-top')
        </div>
    </div>

    <div class="content">
        @yield('contents')
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/qrcode.js') }}"></script>
<script src="{{ asset('alertifyjs/alertify.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/request.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script type="text/javascript">
    const menu_active = document.querySelector('li[data-active="{{ session()->pull('menu-active', '') }}"]');
    if(menu_active != null) {
        menu_active.classList.add('active');
    }
</script>
@yield('script')
</body>
</html>
