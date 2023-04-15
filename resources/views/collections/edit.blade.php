@extends('layouts.layout', ['title' => 'Редактирование коллекции '.$title ])

@section('content')
    <section class="form">
        <div class="container form-container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ ('Редактирование коллекции '.$title) }}</div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-body -->
                            @foreach($collection as $coll_un)
                                <form action="{{ route('collections.update', ['id' => $coll_un->coll_id]) }}" class="form-box" method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @include('collections.parts.form')
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
