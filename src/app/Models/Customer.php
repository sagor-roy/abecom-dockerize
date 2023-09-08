<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $guard = 'customer';

    protected $fillable = [
         'email', 'password',
    ];

    use HasFactory;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function wish(){
        return $this->hasMany(CustomerBirthdayWish::class);
    }

    public function product_question(){
        return $this->hasMany(ProductQuestion::class);
    }
}
