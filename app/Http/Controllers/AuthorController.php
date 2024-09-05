<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\AuthorRequest; // AuthorRequest dosyasinin eklenmesi
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function store(AuthorRequest $request) // Request yerine AuthorRequest kullaniyoruz
    {
        $author = new Author;
        $author->name = $request->name; // Validated edilmiş veriler direkt kullanılır
        $author->save();

        return redirect()->back()->with('success', 'Yazar başarıyla eklendi!');
    }
}
