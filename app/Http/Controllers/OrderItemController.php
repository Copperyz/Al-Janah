<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


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
        //
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
    public function update(Request $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }

    public function get_order_itmes($id)
    {
        $orders = OrderItem::where('order_id', $id)->orderBy('id', 'DESC')->get();
        foreach ($orders as $order) {
            // $order->parcelName = $order->parcelType->name;
            // $order->paymentStatus = $order->payment ? $order->payment->status : 'N/A';
        }
        return Datatables::of($orders)
        ->rawColumns(['Options'])
        ->make(true);
    }
}