<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Bookstore;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

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
        $bookstores = Bookstore::all();  // Tüm kitapçıları al

        return view('books.create', compact('authors', 'bookstores'));
    }


    public function store(BookRequest $request)
    {
        $book = new Book;
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->isbn = $request->isbn;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('cover_images', 'public');
            $book->cover_image = $path;
        }

        $book->save();

        // Kitap satış noktalarını işleyip kaydetmek için
        $bookstoreNames = explode(',', $request->bookstores); // Virgülle ayrılmış stringi array'e çeviriyoruz
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
        $bookstores = Bookstore::all();  // Tüm kitapçıları al

        return view('books.edit', compact('book', 'authors', 'bookstores'));
    }


    public function update(BookRequest $request, Book $book)
    {
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->isbn = $request->isbn;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('cover_images', 'public');
            $book->cover_image = $path;
        }

        $book->save();

        // Kitap satış noktalarını işleyip güncellemek için
        $bookstoreNames = explode(',', $request->bookstores); // Virgülle ayrılmış stringi array'e çeviriyoruz
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
