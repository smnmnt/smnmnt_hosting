@extends('layouts.layout', ['title' => $title])

@section('content')
    <section class="genre_un">
        <div class="container genre_un-container">
            @foreach($genre as $genre_un)
                <img src="{{ asset($genre_un->prod_img) ?? asset('./img/icons/question.svg') }}" alt="asd" class="genre_un-img">
                <!-- /.genre_un-img -->
                <div class="genre_un-left">
                    <div class="genre_un-left-header">
                        <h2 class="genre_un-title"><nobr>{{ $genre_un->genre_name }}</nobr></h2>
                        <!-- /.genre_un-title -->
                        <p class="genre_un-desc">{{ $genre_un->genre_desc }}</p>
                        <div class="genre_un-right-footer">
                            @auth()
                                <a href="{{ route('genres.edit', ['id' => $genre_un->genre_id]) }}" class="btn btn-secondary standart-btn genre-edit_btn">Редактировать жанр</a>
                                <form action="{{ route('genres.destroy', ['id' => $genre_un->genre_id]) }}" method="post" onsubmit="return confirm('Удалить жанр? Вместе с ним будут удалены ВСЕ связанные пластинки!');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger standart-btn" value="Удалить">
                                    <!-- /.standart-btn -->
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
                <!-- /.genre_un-left -->
                @break
            @endforeach
        </div>
        <!-- /.container genre_un-container -->
    </section>
    <!-- /.genre_un_section -->
    <section class="genre_catalogue">
        <div class="container genre_catalogue-container">
            @foreach($genre as $genre_un)
                <h2 class="genre_catalogue-title section-title">Пластинки в жанре <nobr>{{ $genre_un->genre_name }}</nobr></h2>
                @break
            @endforeach
            <div class="catalogue-box-cards">
                @foreach($genre as $genre_un)
                    <div class="catalogue-card standart-card">
                        <a href="{{ route('products.show', ['id' => $genre_un->prod_id]) }}">
                            <img src="{{ asset($genre_un->prod_img) ?? asset('./img/icons/question.svg') }}" onError="this.src='{{ asset('./img/icons/question.svg') }}'" alt="album-cover" class="standart-card-img">
                        </a>
                        <div class="standart-card-spec">
                            <a href="{{ route('products.show', ['id' => $genre_un->prod_id]) }}" class="standart-card-album_name">{{ $genre_un->prod_name }}</a>
                            <div class="standart-card-footer">
                                <p class="standart-card-album_year">{{ $genre_un->prod_year }}</p>
                                <div class="standart-card-price-box">
                                    @if($genre_un->prod_sale == 0)
                                        <p class="standart-card-price-new">{{ $genre_un->prod_price }} ₽</p>
                                    @else
                                        <p class="standart-card-price-old">{{ $genre_un->prod_price }} ₽</p>
                                        <p class="standart-card-price-new">{{ $genre_un->prod_sale }} ₽</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.container genre_catalogue-container -->
    </section>
    <!-- /.genre_catalogue -->
@endsection
