@extends('layouts.layout', ['title' => 'Главная'])

@section('content')
    @if(isset($products) && sizeof($products))
<section class="promo">
    <div class="container promo-container">
        <div class="promo-left">
            <div class="promo-left-text_box">
                <h2 class="promo-left-headline">Распродажа</h2>
                <p class="promo-left-description">Скидки до 50% во всех разделах</p>
            </div>
            <a href="{{ route('products.index') }}" class="promo-left-button btn btn-dark">Перейти в Каталог</a>
        </div>
        <div class="promo-right">
            @foreach($genres as $genre)
                <a href="{{ route('genres.show', ['id' => $genre->genre_id]) }}" class="promo-genre-link">
                    <div class="promo-genre-link-box">
                        <p class="promo-genre-link-title">{{ $genre->genre_name }}</p>
                        <div class="promo-genre-link-img-box">
                            <img src="{{ $genre->prod_img }}" onError="this.src='{{ asset('./img/icons/question.svg') }}'" alt="genre-cover" class="promo-genre-link-img">
                        </div>
                    </div>
                </a>
            @endforeach
            @foreach($genres as $genre)
            <a href="{{ route('genres.index') }}" class="promo-genre-link">
                <div class="promo-genre-link-box">
                    <p class="promo-genre-link-title">Смотреть все жанры</p>
                    <div class="promo-genre-link-img-box">
                        @for($i=0; $i<9; $i++)
                            @foreach($genre_img as $genre_image)
                                <img src="{{ asset($genre_image->prod_img) }}" onError="this.src='{{ asset('./img/icons/question.svg') }}'" alt="genre-cover" class="promo-genre-link-img-all">
                            @endforeach
                        @endfor
                    </div>
                    <!-- /.promo-genre-link-img-box -->
                    </div>
            </a>
                    @break
                @endforeach
        </div>
    </div>
</section>
<!-- /.promo -->
    <section class="admissions">
        <div class="container admissions-container">
            <h2 class="admissions-title section-title">Новое поступление:</h2>
            <div class="admissions-box-cards">
                @foreach($products as $product)
                    <div class="catalogue-card standart-card">
                        <div class="standart-card-header">
                            <a href="{{ route('products.show', ['id' => $product->prod_id]) }}">
                                <img src="{{ asset($product->prod_img) ?? asset('./img/icons/question.svg') }}" onError="this.src='{{ asset('./img/icons/question.svg') }}'" alt="album-cover" class="standart-card-img">
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
    </section>
    <!-- /.admissions -->

@if(sizeof($collections))
    <section class="collections">
        <div class="container collections-container">
            <h2 class="collections-title section-title">Коллекции:</h2>
            <div class="collections-box">
                @foreach($collections as $collection)
                    <a href="{{ route('collections.show', ['id' => $collection->coll_id]) }}" class="collections-link">
                        <div class="collections-link-box">
                            <div class="collections-link-album-box">
                                @foreach($collection_img as $coll_img)
                                    @if($coll_img->coll_id == $collection->coll_id)
                                        <img src="{{ asset($coll_img->prod_img) }}" alt="collection-album-img" class="collections-link-album-img">
                                    @endif
                                @endforeach
                            </div>
                            <div class="collections-link-text_box">
                                <h3 class="collections-link-name">{{ $collection->coll_name }}</h3>
                                <p class="collections-link-desc">{{ $collection->coll_desc }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
  @endif
<!-- /.collections -->
    @else
        <h2 class="text-center text-white">Извините, сайт находится на техобслживании</h2>
    @endif

@endsection
