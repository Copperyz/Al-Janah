<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Trip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['tracking_no', 'delivery_code', 'trip_route_id', 'current_status', 'departure_date', 'estimated_delivery_date', 'created_by', 'updated_by', 'deleted_by'];

     public function shipments()
    {
        return $this->belongsToMany(Shipment::class, 'trip_shipments');
    }

}