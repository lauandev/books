<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepositoryBooks extends Model
{
    /**
     * RepositoryBooks attributes.
     * @var array
     */
    protected $fillable = [
        'user_id', 'book_id', 'status_id'
    ];

    /**
     * Get books.
     */
    public function book()
    {
        return $this->hasMany('App\Models\Book');
    }
}
