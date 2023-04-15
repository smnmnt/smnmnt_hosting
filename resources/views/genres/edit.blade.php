@extends('layouts.layout', ['title' => 'Редактирование жанра '.$genre->first()->genre_name])

@section('content')
    <section class="form">
        <div class="container form-container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ ('Редактирование жанра '.$genre->first()->genre_name) }}</div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-body -->
                            @foreach($genre as $genre_un)
                                <form action="{{ route('genres.update', ['id' => $genre_un->genre_id]) }}" class="form-box" method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @include('genres.parts.form')
                                </form>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
