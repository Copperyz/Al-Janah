<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use App\Models\InventoryItem;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ShipmentSeeder extends Seeder
{
    public function run()
    {
        // Create 1000 shipment records
        for ($i = 0; $i < 10000; $i++) {
            // Create a shipment record
            $shipment = new Shipment();
            $carbonDate = Carbon::now()->subDays(rand(0, 365)); // Random date in the past year
            $shipment->date = $carbonDate->toDateTimeString();
            $shipment->amount = rand(100, 5000); // Random amount between 100 and 5000
            $shipment->currency_id = rand(1, 4); // Random currency id between 1 and 5
            $shipment->shipmentPrice = rand(50, 500); // Random shipment price
            $shipment->customer_id = 1; // Random customer id between 1 and 50
            $shipment->notes = 'Shipment note ' . Str::random(10);
            $shipment->created_by = 1; // Assuming admin created them

            // Generate a unique delivery_code
            do {
                $delivery_code = strtoupper(Str::random(1) . rand(10, 99) . Str::random(1));
            } while (Shipment::where('delivery_code', $delivery_code)->exists());
            $shipment->delivery_code = $delivery_code;

            // Generate a unique tracking number
            do {
                $tracking_no = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
            } while (Shipment::where('tracking_no', $tracking_no)->exists());
            $shipment->tracking_no = $tracking_no;

            $shipment->save();

            // Create random shipment items for each shipment
            $numItems = rand(1, 10); // Each shipment has between 1 and 5 items
            for ($j = 0; $j < $numItems; $j++) {
                $shipmentItem = new ShipmentItem();
                $shipmentItem->shipment_id = $shipment->id;
                $shipmentItem->parcel_types_id = rand(1, 2); // Random parcel type id between 1 and 3
                $shipmentItem->good_types_id = 1; // Random good type id between 1 and 5
                $shipmentItem->price = rand(20, 200); // Random price between 20 and 200
                $shipmentItem->height = rand(10, 100); // Random height between 10 and 100
                $shipmentItem->width = rand(10, 100); // Random width between 10 and 100
                $shipmentItem->weight = rand(1, 50); // Random weight between 1 and 50
                $shipmentItem->length = rand(10, 100); // Random length between 10 and 100
                $shipmentItem->quantity = rand(1, 10); // Random quantity between 1 and 10
                $shipmentItem->save();

                
            }
        }
    }
}
