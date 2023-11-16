<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ShipmentItem extends Model
{
    use HasFactory, SoftDeletes;

    public function goodType()
    {
        return $this->belongsTo(GoodType::class, 'good_types_id');
    }

    public function parcelType()
    {
        return $this->belongsTo(ParcelType::class, 'parcel_types_id');
    }
}