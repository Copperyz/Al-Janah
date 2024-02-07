<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentOnlineController extends Controller
{
    public function handleRedirection(Request $request)
    {
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
        return [
            session('items'),
            session('deliveryCharges'),
            session('packagingType'),
            session('receiverFullName'),
            session('receiverEmail'),
            session('receiverPhoneNumber'),
            session('shippingAddress'),
            session('newDeliveryCost')
    ];
    }
}
