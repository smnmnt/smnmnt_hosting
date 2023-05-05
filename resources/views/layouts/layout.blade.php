<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>smnmnt | {{ $title }}</title>


    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('./img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('./img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('./img/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('./img/favicons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('./img/favicons/safari-pinned-tab.svg') }}" color="#5bbad5">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=ваш API-ключ&lang=ru_RU&load=Geolink"
            type="text/javascript"></script>
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('./css/style.css')}}">
</head>
<body>
<header class="header">
    <div class="container header-container">
        <div class="header-top">
            <a class="header-name header-link" href="/">smnmnt</a>
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="header-link nav-link" aria-current="page" href="/">Главная</a>
                                </li>
                                <li class="nav-item">
                                    <a class="header-link nav-link" href="{{ route('products.index') }}">Каталог</a>
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown nav-link">
                                        <button class="dropdown-toggle header-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Категории
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark " aria-labelledby="dropdownMenuButton1">
                                            <li><a href="{{ route('products.index') }}" class="dropdown-item header-link">Каталог</a></li>
                                            <li><a href="{{ route('bands.index') }}" class="dropdown-item header-link">Исполнители</a></li>
                                            <li><a href="{{ route('genres.index') }}" class="dropdown-item header-link">Жанры</a></li>
                                            <li><a href="{{ route('collections.index') }}" class="dropdown-item header-link">Коллекции</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item nav-link">
                                    <a href="#footer" class="header-link">Контакты</a>
                                </li>
                                <li class="nav-item nav-link">
                                    <a href="{{ route('pay.index') }}" class="header-link">Оплата и доставка</a>
                                </li>
                                @auth()
                                    <li class="nav-item">
                                        <div class="dropdown nav-link">
                                            <button class="dropdown-toggle header-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Создание
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                                                <li><a href="{{ route('products.create') }}" class="dropdown-item header-link">Новая пластинка</a></li>
                                                <li><a href="{{ route('bands.create') }}" class="dropdown-item header-link">Новый исполнитель</a></li>
                                                <li><a href="{{ route('genres.create') }}" class="dropdown-item header-link">Новый жанр</a></li>
                                                <li><a href="{{ route('collections.create') }}" class="dropdown-item header-link">Новая коллекция</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endauth
                                <li class="header-box-buttons nav-item d-flex justify-content-between">
                                    <div class="header-box header-box-buttons">
                                        <button class="header-button nav-link" id="search-btn"><img src="{{ asset('img/icons/search-alt-1.svg') }}" alt="search" class="header-button-img"></button>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="header-button nav-link" data-bs-toggle="modal" data-bs-target="#cartModal"><img src="{{ asset('img/icons/basket-shopping.svg') }}" alt="cart" class="header-button-img"></button>

                                        @guest
                                            @if (Route::has('login'))
                                                <div class="nav-item nav-link">
                                                    <a class="header-button" href="{{ route('login') }}"><img src="{{ asset('img/icons/user-alt-1.svg') }}" alt="profile" class="header-button-img"></a>
                                                </div>
                                    </div>
                                        @endif

                                        {{--                    @if (Route::has('register'))--}}
                                        {{--                        <div class="nav-item">--}}
                                        {{--                            <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>--}}
                                        {{--                        </div>--}}
                                        {{--                    @endif--}}
                                        @else
                                            </div>
                                            <div class="dropdown nav-link">
                                                <button class="dropdown-toggle header-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ Auth::user()->name }}
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="header-link dropdown-item" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault();
                                                                                         document.getElementById('logout-form').submit();">
                                                            {{ __('Выйти') }}
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endguest
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
        </div>



        <!-- /.header-top -->
        <div class="header-bottom header-bottom-closed" id="search-box">
            <form class="header-search-form input-group" action="{{ route('products.index') }}">
                <input type="search" name="search" id="search" class="header-search-input form-control" placeholder="Найти">
                <!-- /#.header-search-input -->
                <button class="header-search-btn btn btn-dark" type="submit">Поиск</button>
                <!-- /.header-search-btn -->
            </form>
            <!-- /.header-search-form -->
        </div>
        <!-- /.header-bottom -->

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

<footer class="footer" id="footer">
    <div class="container footer-container">
        <div class="footer-upper">
            <div class="footer-upper-nav">
                <a href="/" class="footer-link">Главная</a>
                <a href="{{ route('products.index') }}" class="footer-link">Каталог</a>
                <a href="{{ route('pay.index') }}" class="footer-link">Оплата и доставка</a>
            </div>
            <a href="/" class="footer-name footer-link">smnmnt</a>
        </div>
        <div class="footer-downer">
            <span class="footer-adress ymaps-geolink" id="footer-adress-link">
                Московская  обл., г. Жуковский,  ул. Гагарина 64к3
            </span>
            <div class="footer-downer-contacts">
                <a href="tel:+70000000000" class="footer-downer-contact footer-downer-contacts-tel">+7(000)-000-00-00</a>
                <a href="https://github.com/smnmnt" class="footer-downer-contact footer-downer-contacts-link"><img src="{{ asset('img/icons/github-color.svg') }}" alt="github" class="footer-downer-contacts-git"> smnmnt</a>
            </div>
        </div>
    </div>
</footer>
<!-- /.footer -->
<!-- Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="card modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Корзина</h5>
                <button type="button" id="сart-close-btn" style="color: #ffffff; font-size: 20px;" class="сart-close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <h3 class="cart-is_empty" id="cart-is_empty">Ваша корзина пуста</h3>
            <div class="modal-body d-none" id="modal-body">

            </div>
            <div class="modal-footer">
                <p class="fullprice"></p>
                <!-- /.fullprice -->
                <p class="cart-quantity"></p>
                <!-- /.cart-quantity -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <a href="{{ route('pay.index') }}" class="btn btn-primary">Заказать</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
