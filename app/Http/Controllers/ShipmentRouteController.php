<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\ShipmentRoute;
use Yajra\DataTables\Facades\DataTables;


class ShipmentRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        $shipmentRoutes = ShipmentRoute::all();
        return view('shipments_routes.index', compact('shipmentRoutes', 'countries'));
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
        // Validate the request data
        $request->validate([
            'type' => 'required|string',
            'points' => 'required|array',
            'shipment_price' => 'required|numeric',
        ]);

        // Create a new ShipmentRoute instance
        $shipmentRoute = new ShipmentRoute([
            'type' => $request->input('type'),
            'legs' => $request->input('points'),
            'shipment_price' => $request->input('shipment_price'),
        ]);

        // Save the instance to the database
        $shipmentRoute->save();

        return response()->json(['message' => __('Shipment Route added successfully')], 200); 
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        // Get role details including permissions
        $shipmentRoute = ShipmentRoute::find($id);
        return $shipmentRoute;

        if (!$shipmentRoute) {
            return response()->json(['error' => 'Shipment Route not found'], 404);
        }

        return response()->json(['shipmentRoute' => $shipmentRoute]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShipmentRoute $shipmentRoute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'type' => 'required|string',
            'points' => 'required|array',
            'shipment_price' => 'required|numeric', // Use numeric for number validation
        ]);

        // Find the existing ShipmentRoute by ID
        $shipmentRoute = ShipmentRoute::findOrFail($id);

        // Update the attributes
        $shipmentRoute->type = $request->input('type');
        $shipmentRoute->legs = $request->input('points');
        $shipmentRoute->shipment_price = $request->input('shipment_price');

        // Save the updated instance to the database
        $shipmentRoute->save();

        return response()->json(['message' => __('Shipment Route updated successfully')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipmentRoute = ShipmentRoute::find($id);

        if ($shipmentRoute) {
            $shipmentRoute->delete();

            return response()->json(['message' => __('Shipment Route deleted successfully')]);
        }

        return response()->json(['message' => __('Shipment Route not found')], 404);
    }

    public function get_shipment_routes()
    {
        $shipmentRoutes = ShipmentRoute::orderBy('id', 'DESC')->get();

       foreach ($shipmentRoutes as $shipmentRoute) {
            $names = '';
            foreach ($shipmentRoute->legs as $leg) {
                if (!empty($leg['country'])) {
                    $names .= ' - ' . $leg['country'];
                }
            }
            $shipmentRoute->legs_combined = ltrim($names, ' - ');  // Remove leading ' - ' if any
        }

        return Datatables::of($shipmentRoutes)->make(true);
    }
}