@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $book->title }}</h1>
        <p><strong>Yazar:</strong> {{ $book->author }}</p>
        <p><strong>ISBN:</strong> {{ $book->isbn }}</p>

        @if($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Kitap Kapak Görseli" style="max-width: 300px;">
        @endif

        <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">Geri Dön</a>
    </div>
@endsection
