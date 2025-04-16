<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'email',
        'address',
        'postal_code',
        'repair_rating',
        'general_rating',
        'phone_number',
        'iban',
        'website',
        'language_id',
        'user_type_id',
        'subscription_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'phone_number' => 'integer',
    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
