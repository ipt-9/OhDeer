<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'Amount',
        'Timestamp',
        'Date',
        'IsOutstanding',
        'RepairRating',
        'GeneralRating',
        'RatingComment',
        'PostId',
        'UserId',
        'FeeId'
    ];

    protected $casts = [
        'Timestamp' => 'datetime:H:i:s',
        'Date' => 'datetime',
        'IsOutstanding' => 'boolean',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }
}
