<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\TripRoute;
use Yajra\DataTables\Facades\DataTables;
class TripRouteController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        $tripRoutes = TripRoute::all();
        return view('trip_routes.index', compact('tripRoutes', 'countries'));
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
            'trip_price' => 'required|numeric',
        ]);

        // Create a new TripRoute instance
        $tripRoute = new TripRoute([
            'type' => $request->input('type'),
            'legs' => $request->input('points'),
            'trip_price' => $request->input('trip_price'),
        ]);

        // Save the instance to the database
        $tripRoute->save();

        return response()->json(['message' => __('Trip Route added successfully')], 200); 
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        // Get role details including permissions
        $tripRoute = TripRoute::find($id);
        return $tripRoute;

        if (!$tripRoute) {
            return response()->json(['error' => 'Trip Route not found'], 404);
        }

        return response()->json(['tripRoute' => $tripRoute]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TripRoute $tripRoute)
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
            'trip_price' => 'required|numeric', // Use numeric for number validation
        ]);

        // Find the existing TripRoute by ID
        $tripRoute = TripRoute::findOrFail($id);

        // Update the attributes
        $tripRoute->type = $request->input('type');
        $tripRoute->legs = $request->input('points');
        $tripRoute->trip_price = $request->input('trip_price');

        // Save the updated instance to the database
        $tripRoute->save();

        return response()->json(['message' => __('Trip Route updated successfully')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tripRoute = TripRoute::find($id);

        if ($tripRoute) {
            $tripRoute->delete();

            return response()->json(['message' => __('Trip Route deleted successfully')]);
        }

        return response()->json(['message' => __('Trip Route not found')], 404);
    }

    public function get_trip_routes()
    {
        $tripRoutes = TripRoute::orderBy('id', 'DESC')->get();

       foreach ($tripRoutes as $tripRoute) {
            $names = '';
            foreach ($tripRoute->legs as $leg) {
                if (!empty($leg['country'])) {
                    $names .= ' - ' . $leg['country'];
                }
            }
            $tripRoute->legs_combined = ltrim($names, ' - ');  // Remove leading ' - ' if any
        }

        return Datatables::of($tripRoutes)->make(true);
    }
}