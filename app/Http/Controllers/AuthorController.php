<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

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
