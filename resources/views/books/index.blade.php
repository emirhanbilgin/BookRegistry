@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kitaplar</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Yeni Kitap Ekle</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Kitap Adı</th>
                <th scope="col">Yazar</th>
                <th scope="col">ISBN</th>
                <th scope="col">Satış Noktaları</th>
                <th scope="col">İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>
                        @foreach($book->bookstores as $bookstore)
                            <div>
                                <span class="location-icon">📍</span> {{ $bookstore->name }}
                            </div>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Görüntüle</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bu kitabı silinecektir. Onaylıyor musunuz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
