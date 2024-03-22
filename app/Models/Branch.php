<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'city_id',
    'created_by',
    'updated_by',
    'deleted_by',
  ];

  public function inventory()
  {
    return $this->hasMany(Inventory::class);
  }

  public function city()
    {
        return $this->belongsTo(City::class);
    }
}
