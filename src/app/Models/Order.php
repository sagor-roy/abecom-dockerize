<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function order_product()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function delivery_charge()
    {
        return $this->belongsTo(DeliveryCharge::class, 'city', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function order_mail()
    {
        return $this->hasMany(OrderMail::class);
    }

    public function pickup(){
        return $this->belongsTo(PickUp::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
}
