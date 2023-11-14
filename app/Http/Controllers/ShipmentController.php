<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Customer;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipmentsCount = Shipment::count();
        $customersCount = Customer::count();
        $airCount = 0;
        $seaCount = 0;
        return view('shipments.index', compact('shipmentsCount', 'customersCount', 'airCount', 'seaCount'));
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
    public function show(Shipment $shipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipment $shipment)
    {
        //
    }

    public function get_shipments()
    {
        $shipments = Shipment::orderBy('id', 'DESC')->get();
        foreach ($shipments as $order) {
            // $order->customerName = $order->customer ? $order->customer->first_name.' '.$order->customer->last_name : 'N/A';
            // $order->paymentStatus = $order->payment ? $order->payment->status : 'N/A';
        }
        return Datatables::of($shipments)
        ->make(true);
    }
}