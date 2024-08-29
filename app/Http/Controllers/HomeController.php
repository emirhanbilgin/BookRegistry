<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::all();
        return view('home', compact('books'));
    }
    public function show(Book $book)
    {
        // Kullanıcıyı geri döndürecek URL'yi oturumda sakliyoruz
        session(['previous_url' => url()->previous()]);

        return view('books.show', compact('book'));
    }

}
