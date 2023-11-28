<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentHistory extends Model
{
  use HasFactory, SoftDeletes;

  public function trip()
  {
    return $this->belongsTo(Trip::class);
  }

  public function shipment()
  {
    return $this->belongsTo(Shipment::class);
  }
}
