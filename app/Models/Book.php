<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id', 'isbn', 'cover_image'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function bookstores()
    {
        return $this->belongsToMany(Bookstore::class, 'book_bookstore');
    }
}
