<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'is_repair',
        'is_complete',
        'category_id',
        'user_id'
    ];

    protected $casts = [
        'is_repair' => 'boolean',
        'is_complete' => 'boolean',
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
