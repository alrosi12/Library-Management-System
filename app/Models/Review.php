<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // reviewable, member	morphTo, belongsTo
    protected $fillable = [
        'reviewable_id',
        'reviewable_type',
        'member_id',
        'rating',
        'comment',
    ];
    public function reviewable()
    {
        return $this->morphTo();
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
