@extends('layouts.layout', ['title' => 'Редактирование пластинки '.$prod_old->first()->prod_name ])

@section('content')
    <section class="form">
        <div class="container form-container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ ('Редактирование пластинки '.$prod_old->first()->prod_name) }}</div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-body -->
                            @foreach($prod as $prod_un)
                                <form action="{{ route('products.update', ['id' => $prod_un->prod_id]) }}" class="form-box" method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @include('products.parts.form')
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
