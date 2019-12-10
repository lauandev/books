<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $book)
 */
class Book extends Model
{
    /**
     * Books attributes.
     * @var array
     */
    protected $fillable = [
        'title', 'image', 'authors', 'preface', 'language', 'tags'
    ];

    /**
     * Get Ratings of book.
     */
    public function books_ratings()
    {
        return $this->hasMany('App\Models\BooksRating');
    }
}
