<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'Title',
        'Description',
        'Price',
        'IsRepair',
        'IsComplete',
        'CategoryId',
        'UserId'
    ];

    protected $casts = [
        'IsRepair' => 'boolean',
        'IsComplete' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class );
    }

    public function purchases()
    {
        return $this->hasOne(Purchase::class);
    }
}
