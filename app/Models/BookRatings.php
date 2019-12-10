<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookRatings extends Model
{
    protected $fillable = [
        'user_id', 'book_id', 'rating', 'comment'
    ];
}
