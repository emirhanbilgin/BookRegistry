@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kitap Ekle</h1>

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

        <!-- Kitap Ekleme Formu -->
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Kitap Adı:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="author_id">Yazar:</label>
                <select class="form-control" id="author_id" name="author_id" required>
                    <option value="">Yazar Seçin</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Eger yazar bulunamadıysa butonu -->
            <div class="form-group mt-3">
                <a href="{{ url('/home') }}" class="btn btn-warning">Aradığınız yazarı bulamadıysanız lütfen tıklayın</a>
            </div>

            <div class="form-group mt-3">
                <label for="isbn">ISBN Numarası:</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="cover_image">Kitap Kapak Görseli (opsiyonel):</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image" accept=".jpg,.png,jpeg">
            </div>

            <div class="form-group mt-3">
                <label for="bookstores">Kitap Satış Noktaları:</label>
                <input type="text" name="bookstores" id="bookstores" class="form-control" placeholder="Kitap satış noktalarını virgülle ayırarak yazın" value="{{ old('bookstores') }}">
            </div>

            <!-- Ekle Butonu -->
            <button type="submit" class="btn btn-success mt-3">Ekle</button>
        </form>
    </div>
@endsection
