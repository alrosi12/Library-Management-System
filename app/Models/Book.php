<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'isbn',
        'description',
        'publish_date',
        'page_count',
        'language',
        'edition',
        'total_copies',
        'author_id',
        'publisher_id',
        'status',
        'available',
    ];

    protected $casts = [
        'publish_date'
    ];

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
        return $this->belongsToMany(Category::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
    
    public function reviews()
    {
        return $this->morphMany(Review::class , 'reviewable');
    }

    public function currentBorrowing()
    {
        return $this->hasOne(Borrowing::class);
    }
}
