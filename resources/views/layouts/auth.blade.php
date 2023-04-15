<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('./img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('./img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('./img/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('./img/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('./img/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('./css/style.css')}}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


</head>
<body>
<header class="header">
    <div class="container header-container">
        <div class="header-auth">
            <a href="/" class="header-name header-link header-name-auth">smnmnt</a>
            <a href="/" class="header-link">Главная</a>
        </div>
        <!-- /.header-top -->
    </div>
</header>
<!-- /.header -->
<section class="messages-section">
    <div class="container messages-container">

        @if($errors->any())
            @foreach($errors as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <!-- /.container messages-container -->
</section>
<!-- /.messages-section -->

@yield ('content')

</body>
</html>
