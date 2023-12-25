<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

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
}