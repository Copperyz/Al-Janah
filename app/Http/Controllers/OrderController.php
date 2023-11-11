<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Customer;
use App\Models\GoodType;
use App\Models\OrderItem;
use App\Models\ParcelType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $parcelTypes = ParcelType::all();
        $goodTypes = GoodType::all();
        return view('orders.create', compact('customers', 'parcelTypes', 'goodTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'date' => ['required', 'date_format:Y-m-d h:i A'],
            'amount' => ['required', 'numeric'],
            'customer_id' => ['required', 'exists:customers,id'],
            'orderItems' => ['required', 'array', 'min:1'],
            'orderItems.*.parcel_types_id' => ['required', 'exists:parcel_types,id'],
            'orderItems.*.good_types_id' => ['required', 'exists:good_types,id'],
            'orderItems.*.price' => ['required', 'numeric', 'min:1'],
            'orderItems.*.height' => ['required', 'numeric', 'min:1'],
            'orderItems.*.width' => ['required', 'numeric', 'min:1'],
            'orderItems.*.weight' => ['required', 'numeric', 'min:1'],
            'orderItems.*.quantity' => ['required', 'numeric', 'min:1', 'max:50'],
            'notes' => ['nullable', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }

        $order = new Order();
        $validatedDate = $request->input('date');
        $carbonDate = Carbon::createFromFormat('Y-m-d h:i A', $validatedDate);
        $mysqlDate = $carbonDate->toDateTimeString();
        $order->date = $mysqlDate;
        $order->amount = $request->amount;
        $order->customer_id = $request->customer_id;
        // $order->notes = $request->notes;
        $order->save();
        for ($i=0; $i < count($request->orderItems); $i++) { 
            $orderItem = new OrderItem();
                $orderItem->order_id =  $order->id;
                $orderItem->parcel_types_id = $request->orderItems[$i]['parcel_types_id'];
                $orderItem->good_types_id = $request->orderItems[$i]['good_types_id'];
                $orderItem->price = $request->orderItems[$i]['price'];
                $orderItem->height = $request->orderItems[$i]['height'];
                $orderItem->width = $request->orderItems[$i]['width'];
                $orderItem->weight = $request->orderItems[$i]['weight'];
                $orderItem->quantity = $request->orderItems[$i]['quantity'];
                $orderItem->save();
        }
        return response()->json([
            'message' => __('Order added successfully'),
            'order_id' => $order->id,
        ], 200); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order = Order::where('id', $order->id)->first();
        $customers = Customer::all();
        $parcelTypes = ParcelType::all();
        $goodTypes = GoodType::all();
        return view('orders.show', compact('order', 'parcelTypes', 'goodTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $customers = Customer::all();
        $parcelTypes = ParcelType::all();
        $goodTypes = GoodType::all();
        $order = Order::where('id', $order->id)->first();
        $order->orderDate = Carbon::parse($order->date)->format('Y-m-d\Th:i');
        return view('orders.edit', compact('order', 'customers', 'parcelTypes', 'goodTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date_format:Y-m-d h:i A'],
            'amount' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }

        $order = Order::where('id',  $id)->first();
        $validatedDate = $request->input('date');
        $carbonDate = Carbon::createFromFormat('Y-m-d h:i A', $validatedDate);
        $mysqlDate = $carbonDate->toDateTimeString();
        $order->date = $mysqlDate;
        $order->amount = $request->amount;
        // $order->notes = $request->notes;
        $order->save();

        return response()->json([
            'message' => __('Order updated successfully'),
            'order_id' => $order->id,
        ], 200);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderItems = OrderItem::where('order_id', $id);

        if ($orderItems) {
            $orderItems->delete();
            $order = Order::find($id);
            $order->delete();

            return response()->json(['message' => __('Order deleted successfully')]);
        }

        return response()->json(['message' => __('Item not found')], 404);
    }

    public function get_orders()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        foreach ($orders as $order) {
            $order->customerName = $order->customer ? $order->customer->first_name.' '.$order->customer->last_name : 'N/A';
            $order->paymentStatus = $order->payment ? $order->payment->status : 'N/A';
        }
        return Datatables::of($orders)
        ->rawColumns(['Options'])
        ->make(true);
    }
}