@extends('layouts.layout', ['title' => 'Каталог'])

@section('content')
    <section class="sort-section">
        <div class="container sort-container">
            <form action="{{ route('products.index') }}" class="sorter-form" name="sorter" method="get">
                <div class="form-body">
                    <select name="sortByPrice" id="sortByPrice" class="sorter-select form-select" data-bs-theme="dark" aria-label=".form-select-sm" data-role="sort">
                        <option value="default" selected disabled class="sorter-price-select-item">Цена</option>
                        <option value="cheap" class="sorter-price-select-item">Сначала дешевле</option>
                        <option value="expensive" class="sorter-price-select-item">Сначала дороже</option>
                    </select>
                    <select name="sortByDate" id="sortByAddDate" class="sorter-select form-select" aria-label=".form-select-sm" data-role="sort">
                        <option value="default" selected disabled class="sorter-price-select-item">По году</option>
                        <option value="newer" class="sorter-price-select-item">Сначала новее</option>
                        <option value="elder" class="sorter-price-select-item">Сначала старше</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-light">Применить</button>
            </form>
        </div>
    </section>
    <section class="catalogue">
        <div class="container catalogue-container">
            @if(isset($_GET['search']))
                @if(isset($products) && sizeof($products))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Результаты поиска по запросу "{{$_GET['search']}}." Всего совпадений найдено: {{count($products)}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @else
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        По запросу "{{$_GET['search']}}" ничего не найдено
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @else

                <h2 class="catalogue-title section-title">Каталог :</h2>
            @endif
                <div class="catalogue-box-cards">
                    @foreach($products as $product)
                        <div class="catalogue-card standart-card">
                            <div class="standart-card-header">
                                <a href="{{ route('products.show', ['id' => $product->prod_id]) }}">
                                    <img src="{{ $product->prod_img ?? asset('./img/icons/question.svg') }}" onError="this.src='{{ asset('./img/icons/question.svg') }}'" alt="album-cover" class="standart-card-img">
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
{{--                @if(isset($_GET['search']))--}}
{{--                @else--}}
{{--                    <div class="d-flex justify-content-start mt-3">--}}
{{--                        {!! $products->links() !!}--}}
{{--                    </div>--}}
{{--                @endif--}}
        </div>
    </section>
    <!-- /.catalogue -->
@endsection
