<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class OrderItemController extends Controller
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
        // $orderItem->order_id =  $order->id;
        // $orderItem->parcel_types_id = $request->orderItems[$i]['parcel_types_id'];
        // $orderItem->good_types_id = $request->orderItems[$i]['good_types_id'];
        // $orderItem->price = $request->orderItems[$i]['price'];
        // $orderItem->height = $request->orderItems[$i]['height'];
        // $orderItem->width = $request->orderItems[$i]['width'];
        // $orderItem->weight = $request->orderItems[$i]['weight'];
        // $orderItem->quantity = $request->orderItems[$i]['quantity'];
        // $orderItem->save();
    }

    public function add_order_item(Request $request, string $id){
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
        $orderItem = new OrderItem();
        $orderItem->order_id =  $id;
        $orderItem->parcel_types_id = $request->parcel_types_id;
        $orderItem->good_types_id = $request->good_types_id;
        $orderItem->price = $request->price;
        $orderItem->height = $request->height;
        $orderItem->width = $request->width;
        $orderItem->weight = $request->weight;
        $orderItem->quantity = $request->quantity;
        $orderItem->save();

        return response()->json(['message' => __('Item added successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItem $orderItem)
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
        $orderItem = OrderItem::where('id', $id)->first();
        $orderItem->parcel_types_id = $request->parcel_types_id;
        $orderItem->good_types_id = $request->good_types_id;
        $orderItem->price = $request->price;
        $orderItem->height = $request->height;
        $orderItem->width = $request->width;
        $orderItem->weight = $request->weight;
        $orderItem->quantity = $request->quantity;
        $orderItem->save();

        return response()->json(['message' => __('Item updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderItem = OrderItem::find($id);

        if ($orderItem) {
            $orderItem->delete();
            return response()->json(['message' => __('Item deleted successfully')]);
        }

        return response()->json(['message' => __('Item not found')], 404);
    }

    public function get_order_itmes($id)
    {
        $orders = OrderItem::where('order_id', $id)->get();
        foreach ($orders as $orderItem) {
            $orderItem->goodTypeName = $orderItem->goodType->name;
            $orderItem->parcelTypeName = $orderItem->parcelType->name;
        }
        return Datatables::of($orders)
        ->make(true);
    }
}