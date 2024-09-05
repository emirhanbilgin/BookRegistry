@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kitabı Düzenle</h1>

        <!-- Hata Mesajları -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Kitap Düzenleme Formu -->
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Kitap Adı:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}" required>
            </div>

            <div class="form-group">
                <label for="author_id">Yazar:</label>
                <select class="form-control" id="author_id" name="author_id" required>
                    <option value="">Yazar Seçin</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ (old('author_id', $book->author_id) == $author->id) ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="isbn">ISBN Numarası:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="cover_image">Kitap Kapak Görseli (opsiyonel):</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image" accept=".jpg,.png,jpeg">
                @if($book->cover_image)
                    <p>Mevcut Kapak Görseli:</p>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" style="max-width: 200px; max-height: 300px; width: auto; height: auto;">
                @endif
            </div>

            <div class="form-group mt-3">
                <label for="bookstores">Kitap Satış Noktaları:</label>
                <input type="text" class="form-control" id="bookstores" name="bookstores" value="{{ old('bookstores', implode(',', $book->bookstores->pluck('name')->toArray())) }}" placeholder="Kitap satış noktalarını virgülle ayırarak yazın">
            </div>

            <!-- Güncelle Butonu -->
            <button type="submit" class="btn btn-primary mt-3">Güncelle</button>
        </form>
    </div>
@endsection
