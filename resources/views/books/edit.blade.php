@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kitabı Düzenle</h1>

        <!-- Hata Mesajlarını Göster -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Kitap Adı:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}" required>
            </div>
            <div class="form-group">
                <label for="author">Yazar:</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $book->author) }}" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN Numarası:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" required>
            </div>
            <div class="form-group">
                <label for="cover_image">Kitap Kapak Görseli (opsiyonel):</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image" accept=".jpg,.png,.jpeg">
                @if($book->cover_image)
                    <p>Mevcut Kapak Görseli:</p>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Kitap Kapak Görseli" style="max-width: 200px;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
@endsection
