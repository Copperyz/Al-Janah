<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Shipment;
use Illuminate\Support\Str;
use App\Models\ShipmentItem;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\ParcelType;
use App\Models\GoodType;

class ShipmentOnlineController extends Controller
{
    public function handleRedirection(Request $request)
    {
        $referrerUrl = $request->headers->get('referer');
        $jsonString = str_replace(["\r", "\n", "\t"], '', $request->json_data);
        $dataArray = json_decode($jsonString, true);

        // Extract values
        $items = $dataArray['items'];
        // return $items;
        $totalItemsPrice = collect($items)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        $deliveryCharges = 20.00;
        $packagingType = $dataArray['packagingType'];
        $receiverFullName = $dataArray['receiverFullName'];
        $receiverEmail = $dataArray['receiverEmail'];
        $receiverPhoneNumber = $dataArray['receiverPhoneNumber'];
        $shippingAddress = $dataArray['shippingAddress'];

        session(['items' => $items]);
        session(['deliveryCharges' => $deliveryCharges]);
        session(['packagingType' => $packagingType]);
        session(['receiverFullName' => $receiverFullName]);
        session(['receiverEmail' => $receiverEmail]);
        session(['receiverPhoneNumber' => $receiverPhoneNumber]);
        session(['shippingAddress' => $shippingAddress]);
        session(['referrerUrl' => $referrerUrl]);

        // Pass the extracted values to the view
        $pageConfigs = ['myLayout' => 'front'];

        return view('front-pages.checkout-page', compact(
            'items',
            'packagingType',
            'receiverFullName',
            'receiverEmail',
            'receiverPhoneNumber',
            'shippingAddress',
            'totalItemsPrice',
            'deliveryCharges',
            'pageConfigs'
        ));
    }

    public function testForm()
    {
        $json_data = '{
        "items": [
            {
                "name": "Example Item #1 Name",
                "description": "Description of the item #1.",
                "quantity": 2,
                "price": 10,
                "weight": "2 kg",
                "dimensions": "30x20x10 cm",
                "image": "http://example.com/item-image.jpg",
                "category": "Electronics"
            },
            {
                "name": "Example Item #2 Name",
                "description": "Description of the item #2.",
                "quantity": 3,
                "price": 12,
                "weight": "2 kg",
                "dimensions": "30x20x10 cm",
                "image": "http://example.com/item-image.jpg",
                "category": "Electronics"
            }
        ],
        "packagingType": "BOX",
        "receiverFullName": "John Doe",
        "receiverEmail": "johndoe@example.com",
        "receiverPhoneNumber": "+1234567890",
        "shippingAddress": "123 Example Street, Example City, 12345"
    }';

        return view('checkout.testForm', compact('json_data'));
    }
    public function store(Request $request)
    {
        // Check if the customer already exists based on phone or email
        $customerCheck = Customer::where('phone', session('receiverPhoneNumber'))
                        ->orWhere('email', session('receiverEmail'))
                        ->first();

        if (!$customerCheck) {
            // If the customer doesn't exist, create a new customer
            $newCustomer = new Customer();
            $newCustomer->phone = session('receiverPhoneNumber');
            $newCustomer->email = session('receiverEmail');
    
            // Split the receiverFullName into first_name and last_name
            $fullName = explode(' ', session('receiverFullName'));
            $newCustomer->first_name = $fullName[0]; // Assuming the first part is the first name
            $newCustomer->last_name = implode(' ', array_slice($fullName, 1)); // The rest is the last name
            $newCustomer->type = 'Online';
            $newCustomer->status = 1;
            $lastCustomer = Customer::latest()->first();

            if ($lastCustomer) {
            $lastCode = $lastCustomer->customer_code;

            // Extract the letter and number parts
            preg_match('/([A-Z]+)(\d+)/', $lastCode, $matches);

            $letterPart = $matches[1];
            $numberPart = intval($matches[2]);

            // Increment the number part or change the letter if needed
            if ($numberPart < 1000) {
                $numberPart++;
            } else {
                $letterPart = chr(ord($letterPart) + 1);
                $numberPart = 1;
            }

            $newCode = $letterPart . $numberPart;
            } else {
            // If no existing customers, start with A1
            $newCode = 'A1';
            }
            $newCustomer->customer_code = $newCode;
            $newCustomer->address = session('shippingAddress');
    
            $newCustomer->save();
    
            // Get the ID of the newly created customer
            $customerId = $newCustomer->id;
        } else {
            // If the customer already exists, get the ID
            $customerId = $customerCheck->id;
        }

        $items = session('items');
        $formattedItems = [];

        foreach ($items as $item) {
            // Extracting dimensions
            $dimensions = explode('x', $item['dimensions']);
            $length = $dimensions[0];
            $length = filter_var($length, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $width = $dimensions[1];
            $width = filter_var($width, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $height = $dimensions[2];
            $height = filter_var($height, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            $weight = filter_var($item['weight'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
            // Create a new item with separated dimensions
            $formattedItem = [
                'name' => $item['name'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'weight' => $weight,
                'length' => $length,
                'width' => $width,
                'height' => $height,
                'image' => $item['image'],
                'category' => $item['category'],
            ];

            $formattedItems[] = $formattedItem;
        }

        $shipment = new Shipment();
        $carbonDate = Carbon::now();
        $mysqlDate = $carbonDate->toDateTimeString();
        $shipment->date = $mysqlDate;
        $shipment->amount = session('deliveryCharges');
        $shipment->shipmentPrice = session('deliveryCharges');
        $shipment->customer_id = $customerId;
        // $shipment->notes = $request->notes;
        $delivery_code = strtoupper(substr(Str::random(1), 0, 1) . rand(10, 99) . substr(Str::random(1), 0, 1));
        while (Shipment::where('delivery_code', $delivery_code)->exists()) {
            // Regenerate if the generated tracking number already exists
            $delivery_code = strtoupper(substr(Str::random(1), 0, 1) . rand(10, 99) . substr(Str::random(1), 0, 1));
        }
        $shipment->delivery_code = $delivery_code;
        $tracking_no = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        while (Shipment::where('tracking_no', $tracking_no)->exists()) {
            // Regenerate if the generated tracking number already exists
            $tracking_no = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        }
        $shipment->tracking_no = $tracking_no;
        $shipment->current_status = 'In Preparation';
        $shipment->save();

        $parcelType = ParcelType::where('name', session('packagingType'))->first();

        for ($i=0; $i < count($formattedItems); $i++) { 
            $shipmentItem = new ShipmentItem();
                $shipmentItem->shipment_id = $shipment->id;
                $shipmentItem->parcel_types_id = isset($parcelType) ? $parcelType->id : 1;
                $goodTypeId = GoodType::where('name', $formattedItems[$i]['category'])->pluck('id')->first();
                $shipmentItem->good_types_id = $goodTypeId;
                $shipmentItem->name = $formattedItems[$i]['name'];
                $shipmentItem->price = $formattedItems[$i]['price'];
                $shipmentItem->height = $formattedItems[$i]['height'];
                $shipmentItem->width = $formattedItems[$i]['width'];
                $shipmentItem->weight = $formattedItems[$i]['weight'];
                $shipmentItem->length = $formattedItems[$i]['length'];
                $shipmentItem->quantity = $formattedItems[$i]['quantity'];
                $shipmentItem->save();
        }

        $data = [
            'items' => $formattedItems,
            'deliveryCharges' => session('deliveryCharges'),
            'packagingType' => session('packagingType'),
            // 'receiverFullName' => session('receiverFullName'),
            // 'receiverEmail' => session('receiverEmail'),
            // 'receiverPhoneNumber' => session('receiverPhoneNumber'),
            // 'shippingAddress' => session('shippingAddress'),
            'referrerUrl' => session('referrerUrl'),
            'newDeliveryCost' => session('newDeliveryCost'),
            'shipmentId' =>  $shipment->id,
            'customerId' => $customerId, // Return the customer ID for further processing if needed
        ];

        return response()->json(['message' => __('Shipment added successfully'), 'data' => $data]);


        
    }

    public function webHook()
    {
        return view('checkout.webhook.blade');
    }

}
