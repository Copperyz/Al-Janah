<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripRoute extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'legs', 'trip_price'];

    protected $casts = [
        'legs' => 'array',
    ];
}