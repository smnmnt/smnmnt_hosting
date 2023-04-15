@extends('layouts.layout', ['title' => 'Коллекции'])

@section('content')
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
                                        <img src="{{ $coll_img->prod_img }}" alt="collection-album-img" class="collections-link-album-img">
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
    <!-- /.bands -->
@endsection
