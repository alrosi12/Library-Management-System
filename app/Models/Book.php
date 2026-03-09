<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function currentBorrowing()
    {
        return $this->hasOne(Borrowing::class);
    }


    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['title'] ?? false, function ($builder, $value) {
            $builder->where('title', 'LIKE', "%{$value}%");
        });
        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->where('status', $value);
        });

        $builder->when($filters['search'] ?? false, function ($builder, $value) {

            $builder->where('title', 'LIKE', "%{$value}%")
                ->orWhere('isbn', 'LIKE', "%{$value}%")
                ->orWhere('author_id', 'LIKE', "%{$value}%");
        });

        // $builder->when($filters['category'] ?? false, function ($builder, $value) {

        //     $builder->where('categories', 'LIKE', "%{$value}%");
        // });

        $builder->when($filters['language'] ?? false, function ($builder, $value) {

            $builder->where('language', 'LIKE', "%{$value}%");
        });

        $builder->when($filters['sort'] ?? false, function ($builder, $value) {
            //->orderBy('title', 'asc')

            // $builder->Row('SELECT * FROM `books` ORDER BY `books`.`title` ASC');
        });
    }
    public function scopeAvailable(Builder $query)
    {
        return $query->where('status', 'available');
    }
    public function scopeByLanguage(Builder $query, $lang)
    {
        return $query->where('language', $lang);
    }
    // Accessors

    public function getIsAvailableAttribute()
    {
        return $this->status = 'available' && $this->available_copies > 0;
    }

    public function getAvailableCopiesAttribute()
    {
        return $this->total_copies - (Book::where('status', 'borrowed')->count());
    }
}
