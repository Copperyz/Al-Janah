<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\FuncCall;

class Trip extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'tracking_no',
    'trip_route_id',
    'current_status',
    'current_route_leg',
    'departure_date',
    'estimated_delivery_date',
    'created_by',
    'updated_by',
    'deleted_by',
  ];

  public function tripRoute()
  {
    return $this->belongsTo(TripRoute::class);
  }

  public function tripHistory()
  {
    return $this->hasMany(TripHistory::class);
  }
}
