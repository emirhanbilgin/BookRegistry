<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:authors,name',
        ]);

        $author = new Author;
        $author->name = $request->name;
        $author->save();

        return redirect()->back()->with('success', 'Yazar başarıyla eklendi!');
    }
}
