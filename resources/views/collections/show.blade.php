@extends('layouts.layout', ['title' => $title])

@section('content')
    <section class="collection">
        @foreach($collection as $coll_un)
        <div class="container collection-container" id="{{ $coll_un->coll_id }}">
                <div class="collection-left-header">
                    <h2 class="collection-title">{{ $coll_un->coll_name }}</h2>
                    <!-- /.collection-title -->
                    <p class="collection-desc">{{ $coll_un->coll_desc }}</p>
                    <div class="collection-price-box">
                        <p class="standart-card-price-old product-price-old">{{ $coll_un->coll_old_price }} ₽</p>
                        <p class="standart-card-price-new product-price-new">{{ $coll_un->coll_new_price }} ₽</p>
                    </div>
                    <div class="collection-box-buttons product-right-footer">
                        <button class="btn btn-light collection-add_to_cart add_to_cart collection-buttons standart-btn" value="{{ $coll_un->coll_id }}">В корзину</button>
                        @auth()
                            <a href="{{ route('collections.edit', ['id' => $coll_un->coll_id]) }}" class="btn btn-secondary standart-btn collection-buttons">Редактировать Исполнителя</a>
                            <form action="{{ route('collections.destroy', ['id' => $coll_un->coll_id]) }}" method="post" onsubmit="return confirm('Удалить Коллекцию?');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger standart-btn collection-buttons" value="Удалить">
                                <!-- /.standart-btn -->
                            </form>
                        @endauth
                    </div>

                </div>
        </div>
        <!-- /.container collection-container -->
            @break
        @endforeach
    </section>
    <!-- /.collection_section -->
    <section class="collection_catalogue">
        <div class="container collection_catalogue-container">
            @foreach($collection as $coll_un)
                <h2 class="collection_catalogue-title section-title">Коллекция пластинок {{ $coll_un->coll_name }}</h2>
                @break
            @endforeach
            <div class="catalogue-box-cards">
                @foreach($collection as $product)
                    <div class="catalogue-card standart-card">
                        <div class="standart-card-header">
                            <a href="{{ route('products.show', ['id' => $product->prod_id]) }}">
                                <img src="{{ asset($product->prod_img) ?? asset('./img/icons/question.svg') }}" alt="album-cover" class="standart-card-img">
                            </a>
                            <div class="standart-card-info">
                                <a href="{{ route('bands.show', ['id' => $product->band_id]) }}" class="standart-card-band_name">{{ $product->band_name }}</a>
                                <a href="{{ route('products.show', ['id' => $product->prod_id]) }}" class="standart-card-album_name">{{ $product->prod_name }}</a>
                            </div>
                        </div>
                        <div class="standart-card-spec">

                            <div class="standart-card-footer">
                                <p class="standart-card-album_year">{{ $product->prod_year }}</p>
                                <div class="standart-card-price-box">
                                    @if($product->prod_sale == 0)
                                        <p class="standart-card-price-new">{{ $product->prod_price }} ₽</p>
                                    @else
                                        <p class="standart-card-price-old">{{ $product->prod_price }} ₽</p>
                                        <p class="standart-card-price-new">{{ $product->prod_sale }} ₽</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /.container band_catalogue-container -->
    </section>
    <!-- /.band_catalogue -->
@endsection
