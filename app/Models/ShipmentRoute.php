<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentRoute extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'legs', 'shipment_price'];

    protected $casts = [
        'legs' => 'array',
    ];
}