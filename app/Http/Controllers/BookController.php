<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books',
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'isbn.unique' => 'Bu ISBN numarası daha önce kullanılmış lütfen başka bir numara giriniz.',
        ]);

        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->isbn = $request->isbn;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('cover_images', 'public');
            $book->cover_image = $path;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla eklendi!');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'cover_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'isbn.unique' => 'Bu ISBN numarası daha önce kullanılmış lütfen başka bir numara giriniz.',
        ]);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->isbn = $request->isbn;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('cover_images', 'public');
            $book->cover_image = $path;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla güncellendi!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla silindi!');
    }
}
