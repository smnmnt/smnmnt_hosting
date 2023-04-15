@extends('layouts.layout', ['title' => 'Список исполнителей'])

@section('content')
    <section class="bands">
        <div class="container bands-container">
            <h2 class="bands-title section-title">Список исполнителей:</h2>
            <div class="bands-box-cards">
                @foreach($bands as $band)
                    <a href="{{ route('bands.show', ['id' => $band->band_id]) }}" class="bands-card standart-card">
                        <img src="{{ $band->band_img ?? asset('./img/icons/question.svg') }}" alt="album-cover" class="standart-card-img">
                        <div class="standart-card-spec">
                            <p class="standart-card-band_name">{{ $band->band_name }}</p>
                        </div>
                    </a>
                @endforeach

                    @auth()
                        <a href="{{ route('bands.create') }}" class="bands-card standart-card">
                            <img src="{{ asset('./img/icons/plus.svg') ?? asset('./img/icons/question.svg') }}" alt="album-cover" class="standart-card-img">
                            <div class="standart-card-spec">
                                <p class="standart-card-band_name">Добавить исполнителя</p>
                            </div>
                        </a>
                    @endauth
            </div>
        </div>
    </section>
    <!-- /.bands -->
@endsection
