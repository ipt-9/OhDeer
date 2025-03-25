<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = ['IsPaid', 'DueDate', 'Amount'];

    protected $casts = [
        'IsPaid' => 'boolean',
        'DueDate' => 'datetime',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
