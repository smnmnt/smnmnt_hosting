@extends('layouts.layout', ['title' => 'Жанры'])

@section('content')
    <section class="genre">
        <div class="container genre-container">
            <h2 class="genre-title section-title">Список жанров:</h2>
            <div class="genre-box-cards">
                @foreach($genres as $genre)
                    <a href="{{ route('genres.show', ['id' => $genre->genre_id]) }}" class="genre-card standart-card">
                        <img src="{{ $genre->prod_img ?? asset('./img/icons/question.svg') }}" alt="album-cover" class="standart-card-img">
                        <div class="standart-card-spec">
                            <p class="standart-card-band_name">{{ $genre->genre_name }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /.genre -->
@endsection
