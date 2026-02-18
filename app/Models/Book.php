<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;


    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function currentBorrowing()
    {
        return $this->hasOne(Borrowing::class)->where('returned_at', null);
    }
}
