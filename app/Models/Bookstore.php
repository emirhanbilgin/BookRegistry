<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookstore extends Model
{
    use HasFactory;

    // Kitlesel atamaya izin verilen sütunlar
    protected $fillable = ['name'];
}
