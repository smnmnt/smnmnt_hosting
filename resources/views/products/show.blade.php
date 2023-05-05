@extends('layouts.layout', ['title' => $title])

@section('content')
<section class="product_section">
    @foreach($product as $prod)
    <div class="container product-container" id="{{ $prod->prod_id }}">
        <img src="{{ asset($prod->prod_img) ?? asset('./img/icons/question.svg') }}" alt="asd" class="product-img">
            <!-- /.product-img -->
        <div class="product-right">
            <div class="product-right-header">
                <h2 class="product-title">{{ $prod->prod_name }}</h2>
                <!-- /.product-title -->
                <div class="product-info">
                    <a href="{{ route('bands.show', ['id' => $prod->band_id]) }}" class="product-author">{{ $prod->band_name }}</a>
                    <a href="{{ route('genres.show', ['id' => $prod->genre_id]) }}" class="product-genre">{{ $prod->genre_name }}</a>
                </div>
                <!-- /.product-desc -->
                <p class="product-desc">{{ $prod->prod_desc }}</p>
            </div>
            <div class="product-right-footer">
                <button type="submit" class="btn btn-light product-add_to_cart add_to_cart standart-btn" id="product-add_to_cart" value="{{ $prod->prod_id }}">В корзину</button>
                @auth()
                    <a href="{{ route('products.edit', ['id' => $prod->prod_id]) }}" class="btn btn-secondary standart-btn">Редактировать Пластинку</a>
                    <form action="{{ route('products.destroy', ['id' => $prod->prod_id]) }}" method="post" onsubmit="return confirm('Удалить Пластинку?');">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger standart-btn" value="Удалить">
                        <!-- /.standart-btn -->
                    </form>
                @endauth
                <div class="product-right-stat">
                    <p class="product-album_year">Год выхода: {{ $prod->prod_year }}</p>
                    <div class="standart-card-price-box product-price-box">
                        @if($prod->prod_sale == 0)
                            <p class="standart-card-price standart-card-price-new product-price-new">{{ $prod->prod_price }} ₽</p>
                        @else
                            <p class="standart-card-price standart-card-price-old product-price-old">{{ $prod->prod_price }} ₽</p>
                            <p class="standart-card-price-new product-price-new">{{ $prod->prod_sale }} ₽</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /.product-right -->
    </div>
    <!-- /.container product-container -->
    @endforeach
</section>
<!-- /.product_section -->
@endsection
