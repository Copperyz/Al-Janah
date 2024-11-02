<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'type', 'address_line', 'city_id', 'is_default'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function city()  
    {
        return $this->belongsTo(City::class);
    }
}
