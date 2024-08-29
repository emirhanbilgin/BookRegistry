@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $book->title }}</h1>

        <p><strong>Yazar:</strong> {{ $book->author->name }}</p>
        <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
        @if ($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="img-fluid">
        @endif
    </div>
@endsection
