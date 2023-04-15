@extends('layouts.layout', ['title' => 'Редактирование исполнителя '.$band->first()->band_name])

@section('content')
    <section class="form">
        <div class="container form-container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ ('Редактирование исполнителя '.$band->first()->band_name) }}</div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-body -->
                            @foreach($band as $band_un)
                                <form action="{{ route('bands.update', ['id' => $band_un->band_id]) }}" class="form-box" method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @include('bands.parts.form')
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
