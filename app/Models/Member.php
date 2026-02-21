<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'membership_date',
        'is_active'
    ];

    // public function books()
    // {
    //     return $this->hasMany(Book::class);
    // }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    public function currentBorrowings()
    {
        return $this->hasMany(Borrowing::class)->where('returned_at', null);
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('name', 'LIKE', "%{$value}%");
        });
        $builder->when($filters['is_active'] ?? false, function ($builder, $value) {
            $builder->where('is_active', $value);
        });
    }
}
