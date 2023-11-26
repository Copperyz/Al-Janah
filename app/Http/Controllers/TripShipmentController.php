<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\TripShipment;
use Illuminate\Http\Request;

class TripShipmentController extends Controller
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
    public function show(TripShipment $tripShipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripShipment $tripShipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $trip = Trip::findOrFail($id);

        // Extract selected rows from the request
        $selectedRows = $request->selectedRows;

        // Extract the shipment IDs from the selected rows
        $shipmentIds = collect($selectedRows)->pluck('id');

        // Sync the shipment IDs with the trip_shipments table
        $trip->shipments()->sync($shipmentIds);

        // Return a response or perform additional actions as needed
        return response()->json(['message' => __('Trip Shipments updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripShipment $tripShipment)
    {
        //
    }
}