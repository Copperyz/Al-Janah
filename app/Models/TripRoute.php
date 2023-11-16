<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TripRoute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['type', 'legs', 'trip_price', 'created_by', 'updated_by', 'deleted_by'];

    protected $casts = [
        'legs' => 'array',
    ];
}