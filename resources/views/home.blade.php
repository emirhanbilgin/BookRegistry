@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }} {{ auth()->user()->name }}

                        <div class="mt-4">
                            <h3>Kitap Listesi</h3>
                            @if($books->count() > 0)
                                <ul class="list-group">
                                    @foreach($books as $book)
                                        <li class="list-group-item">
                                            <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>Henüz eklenmiş bir kitap yok.</p>
                            @endif

                            <a href="{{ route('books.create') }}" class="btn btn-primary mt-3">Kitap Ekle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
