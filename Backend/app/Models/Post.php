<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'is_repair' => 'boolean',
        'is_complete' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'description',
        'price',
        'is_repair',
        'is_complete',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'category_id',
        'user_id'
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
