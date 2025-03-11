<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = ['is_paid', 'due_date', 'amount'];

    protected $casts = [
        'is_paid' => 'boolean',
        'due_date' => 'datetime',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
