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
        $packagingType = $dataArray['packagingType'];
        $receiverFullName = $dataArray['receiverFullName'];
        $receiverEmail = $dataArray['receiverEmail'];
        $receiverPhoneNumber = $dataArray['receiverPhoneNumber'];
        $shippingAddress = $dataArray['shippingAddress'];


        return $items;

        // Pass the extracted values to the view
        return view('checkout', compact(
            'items',
            'packagingType',
            'receiverFullName',
            'receiverEmail',
            'receiverPhoneNumber',
            'shippingAddress'
        ));
    }

    public function testForm()
    {
        $json_data = '{
        "items": [
            {
                "name": "Example Item #1 Name",
                "description": "Description of the item #1.",
                "quantity": 10,
                "weight": "2 kg",
                "dimensions": "30x20x10 cm",
                "image": "http://example.com/item-image.jpg",
                "category": "Electronics"
            },
            {
                "name": "Example Item #2 Name",
                "description": "Description of the item #2.",
                "quantity": 10,
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
}
