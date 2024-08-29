<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Bookstore;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $books = Book::with('author', 'bookstores')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id', // Yazar ID'sinin geçerli olduğunu kontrol et
            'isbn' => 'required|unique:books,isbn|max:13',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'bookstores' => 'required|string', // Kitap satış noktalarının doğrulanması (string olarak)
        ], [
            'isbn.unique' => 'Bu ISBN numarası daha önce kullanılmış lütfen başka bir numara giriniz.',
        ]);

        $book = new Book;
        $book->title = $request->title;
        $book->author_id = $request->author_id; // author_id'nin atandığından emin ol
        $book->isbn = $request->isbn;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('cover_images', 'public');
            $book->cover_image = $path;
        }

        $book->save();

        // Kitap satış noktalarını işleyip kaydetmek için
        $bookstoreNames = explode(',', $request->bookstores);
        $bookstores = [];
        foreach ($bookstoreNames as $name) {
            $bookstores[] = Bookstore::firstOrCreate(['name' => trim($name)])->id;
        }
        $book->bookstores()->sync($bookstores);

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla eklendi!');
    }

    public function show(Book $book)
    {
        $previousPage = session()->get('previousPage', route('home'));

        return view('books.show', compact('book', 'previousPage'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $bookstores = Bookstore::all(); // Kitapçılar listesini alıyoruz
        return view('books.edit', compact('book', 'authors', 'bookstores'));
    }


    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'isbn' => 'required|unique:books,isbn,' . $book->id . '|max:13',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'bookstores' => 'required|string',  // Kitap satış noktalarının doğrulanması (string olarak)
        ], [
            'isbn.unique' => 'Bu ISBN numarası daha önce kullanılmış lütfen başka bir numara giriniz.',
        ]);

        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->isbn = $request->isbn;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('cover_images', 'public');
            $book->cover_image = $path;
        }

        $book->save();

        // Kitap satış noktalarını güncellemek için
        $bookstoreNames = explode(',', $request->bookstores);
        $bookstores = [];
        foreach ($bookstoreNames as $name) {
            $bookstores[] = Bookstore::firstOrCreate(['name' => trim($name)])->id;
        }
        $book->bookstores()->sync($bookstores);

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla güncellendi!');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla silindi!');
    }
}
