<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'book_id',
        'member_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'status',
    ];
    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date' => 'date',
        'returned_at' => 'datetime',
        'status' => 'enum:borrowed,returned,overdue',
    ];
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
