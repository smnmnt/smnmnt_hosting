@extends('layouts.layout', ['title' => $title])

@section('content')
    <section class="band">
        <div class="container band-container">
            @foreach($band as $band_un)
                <img src="{{ asset($band_un->band_img) ?? asset('./img/icons/question.svg') }}" alt="asd" class="band-img">
                <!-- /.band-img -->
                <div class="band-left">
                    <div class="band-left-header">
                        <h2 class="band-title"><nobr>{{ $band_un->band_name }}</nobr></h2>
                        <!-- /.band-title -->
                        <p class="band-desc">{{ $band_un->band_desc }}</p>
                        <div class="band-right-footer">
                            @auth()
                                    <a href="{{ route('bands.edit', ['id' => $band_un->band_id]) }}" class="btn btn-secondary standart-btn band-edit_btn">Редактировать</a>
                                    <form action="{{ route('bands.destroy', ['id' => $band_un->band_id]) }}" method="post" onsubmit="return confirm('Удалить Исполнителя? Вместе с исполнителем будут удалены ВСЕ связанные пластинкии!');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger standart-btn" value="Удалить">
                                        <!-- /.standart-btn -->
                                    </form>
                            @endauth
                        </div>
                    </div>
                </div>
                <!-- /.band-left -->
                @break
            @endforeach
        </div>
        <!-- /.container band-container -->
    </section>
    <!-- /.band_section -->
    <section class="band_catalogue">
        <div class="container band_catalogue-container">
            @foreach($band as $band_un)
                <h2 class="band_catalogue-title section-title">Пластинки исполнителя <nobr>{{ $band_un->band_name }}</nobr></h2>
                @break
            @endforeach
            <div class="catalogue-box-cards">
                @foreach($band_products as $product)
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
        <!-- /.container band_catalogue-container -->
    </section>
    <!-- /.band_catalogue -->
@endsection
