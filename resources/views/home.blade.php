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

                        {{ __('You are logged in!') }}
                        {{ auth()->user()->name }}

                        <h3>Kitap Listesi</h3>
                        @if($books->count() > 0)
                            <ul class="list-group">
                                @foreach($books as $book)
                                    <li class="list-group-item">
                                        <a href="{{ route('books.show', $book->id) }}" onclick="sessionStorage.setItem('previousPage', '/home')">{{ $book->title }}</a>
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

        <!-- Yazar Ekleme Formu -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Yazar Ekle</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('authors.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Yazar Adı:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Yazar Ekle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
