@extends('layouts.layout', ['title' => 'Новая коллекция'])

@section('content')
    <section class="form">
        <div class="container form-container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ ('Создание новой коллекции') }}</div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-body -->
                            <form action="{{ route('collections.store') }}" method="post" class="form-box" enctype="multipart/form-data">
                                @include('collections.parts.form')
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
