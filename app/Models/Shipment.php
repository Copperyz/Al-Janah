<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
  use HasFactory, SoftDeletes;

  public function customer()
  {
    return $this->belongsTo(Customer::class, 'customer_id');
  }

  public function payment()
  {
    return $this->hasOne(Payment::class, 'shipment_id');
  }

  public function trips()
  {
    return $this->belongsToMany(Trip::class, 'trip_shipments');
  }

  public function shipmentHistory()
  {
    return $this->hasMany(ShipmentHistory::class);
  }

  public function currency()
  {
    return $this->belongsTo(Currency::class, 'currency_id');
  }
}
