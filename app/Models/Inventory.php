<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
  use HasFactory, SoftDeletes;

  public function inventoryItem()
  {
    return $this->hasMany(InventoryItem::class);
  }

  public function branch()
  {
    return $this->belongsTo(Branch::class);
  }
}
