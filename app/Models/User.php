<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'gender',  
        'role',
        'is_active',
        'user_image',
        'phone_number',
        'user_address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'creator_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'creator_id');
    }
    public function userHistory(): HasMany
    {
        return $this->hasMany(UserHistory::class);
    }
    public function userPayment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

}
