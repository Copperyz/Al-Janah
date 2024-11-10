<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // Other fields here,
        'shipment_id',
        'date',
        'shipment_amount',
        'order_amount',
        'additional_amount',
        'total_amount',
        'currency_id',
        'exchange_rate',
        'payment_method',
        'transaction_id',
        'created_by',
        'updated_by'
    ];
     

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
