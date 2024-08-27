@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hoşgeldiniz</div>

                    <div class="card-body">
                        <p>Laravel ile BookRegistry uygulamasına hoş geldiniz!</p>
                        <a href="{{ route('books.index') }}" class="btn btn-primary">Kitap Listesini Görmek İçin Tıklayınız</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
