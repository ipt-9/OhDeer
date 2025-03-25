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
        'Username',
        'Password',
        'Email',
        'RepairRating',
        'GeneralRating',
        'Address',
        'PhoneNumber',
        'IBAN',
        'UserTypeId',
        'LanguageId',
        'SubscriptionId',
        'HashSalt'
    ];

    protected $hidden = [
        'Password',
        'RememberToken',
        'HashSalt',
    ];

    protected $casts = [
        'EmailVerifiedAt' => 'datetime',
        'Password' => 'hashed',
        'PhoneNumber' => 'integer',
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
