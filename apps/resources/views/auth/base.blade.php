<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Ico-Crypto</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/info.png') }}">
    @include('meta_seo')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('alertifyjs/css/alertify.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('alertifyjs/css/themes/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('fontawesome/all.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/global.css?i=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css?i=' . time()) }}">
</head>
<body>

@include('bg_particle')

<section id="box-auth" class="position-relative">
    <div class="form-auth">
        <div class="header-img mb-4">
            <img src="{{ asset('assets/img/logo-white.png') }}" alt="Logo">
        </div>
        <div class="form-auth-content">
            @yield('form-auth')
        </div>
    </div>
</section>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('alertifyjs/alertify.min.js') }}"></script>
<script src="{{ asset('js/request.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script src="{{ asset('js/auth.js?i=' . time()) }}"></script>
@include('show_mgs_notif')
@yield('script')
</body>
</html>
