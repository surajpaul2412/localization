<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Package;
use App\Models\Wishlist;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id', 'name', 'email', 'email_verified_at', 'mobile', 'dob', 'gender', 'password', 'avatar'
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
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\UserAddress');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function wishlist(){
        return $this->hasMany('App\Models\Wishlist');
    }

    // public function wishlists()
    // {
    //     return $this->belongsToMany(Package::class, 'wishlists', 'user_id', 'package_id')->using(Wishlist::class);
    // }
}
