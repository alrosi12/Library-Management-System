<?php

namespace App\Models;

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
        'is_active',
    ];
    protected $casts = [
        'membership_date',
        'is_active'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function currentBorrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
