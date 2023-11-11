<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
  use HasFactory, SoftDeletes;

  public function inventory()
  {
    return $this->belongsTo(Inventory::class);
  }
}
