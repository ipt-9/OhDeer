<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['subscription_name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
