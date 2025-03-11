<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'timestamp',
        'date',
        'is_outstanding',
        'repair_rating',
        'general_rating',
        'rating_comment',
        'post_id',
        'user_id',
        'fee_id'
    ];

    protected $casts = [
        'timestamp' => 'datetime:H:i:s',
        'date' => 'datetime',
        'is_outstanding' => 'boolean',
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
