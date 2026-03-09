<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'member_id',
        'borrowed_at',
        'due_date',
        'returnd_at',
        'status',
        'nots',
    ];

    protected $casts = [
        'borrowed_at',
        'due_date',
        'returnd_at',
        'status'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function scopeOverue(Builder $query)
    {
        return $query->where('due_date ', '<', Carbon::now())
            ->when('returned_at', null);
    }
    public function scopeActive(Builder $query)
    {
        return $query->where('returned_at', null);
    }
    // Accessors

    public function getIsOverdueAttribute()
    {
        if ($this->due_date > 14 && $this->returnd_at = null) {
            return true;
        }
    }
}
