<?php

namespace App\Http\Controllers;

use App\Models\ShipmentItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class ShipmentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $request;
    }

    public function add_shipment_item(Request $request, string $id){
        $validator = Validator::make($request->all(), [
            'good_types_id' => ['required', 'exists:good_types,id'],
            'parcel_types_id' => ['required', 'exists:parcel_types,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'height' => ['required', 'numeric', 'min:0'],
            'width' => ['required', 'numeric', 'min:0'],
            'weight' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'numeric', 'min:0'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }
        $shipmentItem = new ShipmentItem();
        $shipmentItem->shipment_id =  $id;
        $shipmentItem->parcel_types_id = $request->parcel_types_id;
        $shipmentItem->good_types_id = $request->good_types_id;
        $shipmentItem->price = $request->price;
        $shipmentItem->height = $request->height;
        $shipmentItem->width = $request->width;
        $shipmentItem->weight = $request->weight;
        $shipmentItem->quantity = $request->quantity;
        $shipmentItem->save();

        return response()->json(['message' => __('Item added successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShipmentItem $shipmentItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShipmentItem $shipmentItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'good_types_id' => ['required', 'exists:good_types,id'],
            'parcel_types_id' => ['required', 'exists:parcel_types,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'height' => ['required', 'numeric', 'min:0'],
            'width' => ['required', 'numeric', 'min:0'],
            'weight' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'numeric', 'min:0'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }
        $shipmentItem = ShipmentItem::where('id', $id)->first();
        $shipmentItem->parcel_types_id = $request->parcel_types_id;
        $shipmentItem->good_types_id = $request->good_types_id;
        $shipmentItem->price = $request->price;
        $shipmentItem->height = $request->height;
        $shipmentItem->width = $request->width;
        $shipmentItem->weight = $request->weight;
        $shipmentItem->quantity = $request->quantity;
        $shipmentItem->save();

        return response()->json(['message' => __('Item updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipmentItem = ShipmentItem::find($id);

        if ($shipmentItem) {
            $shipmentItem->delete();
            return response()->json(['message' => __('Item deleted successfully')]);
        }

        return response()->json(['message' => __('Item not found')], 404);
    }

    public function get_shipment_itmes($id)
    {
        $shipmentItems = ShipmentItem::where('shipment_id', $id)->get();
        foreach ($shipmentItems as $shipmentItem) {
            $shipmentItem->goodTypeName = $shipmentItem->goodType->name;
            $shipmentItem->parcelTypeName = $shipmentItem->parcelType->name;
        }
        return Datatables::of($shipmentItems)
        ->make(true);
    }
}