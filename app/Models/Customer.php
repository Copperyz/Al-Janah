<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->customer_reference = (string) Str::orderedUuid(); // Generate UUID using Str::uuid()
        });
    }

     public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

     public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

     public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
    public function cashBalance()
    {
        return $this->hasMany(CashBalance::class);
    }
    public function coupons()
    {
        return $this->hasMany(Coupons::class);
    }

    public function totalAmountDecrease($amount)
    {
        if ($this->total_amount >= $amount) {
            $this->decrement('total_amount', $amount);
            return true;
        } else {
            return false; // Insufficient balance
        }
    }

    public function totalAmountIncrease($amount)
    {
        $this->increment('total_amount', $amount);
    }
}