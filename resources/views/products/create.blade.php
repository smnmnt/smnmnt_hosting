@extends('layouts.layout', ['title' => 'Новая пластинка'])

@section('content')
    <section class="form">
        <div class="container form-container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ ('Добавление новой пластинки') }}</div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-body -->
                            <form action="{{ route('products.store') }}" method="post" class="form-box" enctype="multipart/form-data">
                                @include('products.parts.form')
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
