<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email'];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->customer_reference = (string) Str::orderedUuid(); // Generate UUID using Str::uuid()
        });
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
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

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, Shipment::class);
    }

    public function getTotalShipmentPrice()
    {
        return $this->payments()->sum('shipment_amount');
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