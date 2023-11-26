<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trip;
use App\Models\Customer;
use App\Models\Shipment;
use App\Models\TripRoute;
use Illuminate\Support\Str;
use App\Models\TripShipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $tripsCount = Trip::count();
    $customersCount = Customer::count();
    $deliveredCount = 0;
    $inProgressCount = 0;
    $tripRoutes = TripRoute::all();
    $tripRoutes = TripRoute::all();
    foreach ($tripRoutes as $tripRoute) {
      $legsCombined = '';
      foreach ($tripRoute->legs as $leg) {
        if (!empty($leg['country'])) {
          $legsCombined .= ($legsCombined ? '. ' : '') . ' ' . __($leg['type']) . ' (' . __($leg['country']) . ') ';
        }
      }
      $tripRoute->legs_combined = $legsCombined . '. ' . __('Type') . ' (' . __($tripRoute->type) . ')';
    }
    return view(
      'trips.index',
      compact('tripsCount', 'customersCount', 'deliveredCount', 'inProgressCount', 'tripRoutes')
    );
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
    $validator = Validator::make($request->all(), [
      'trip_route_id' => ['required', 'string', 'exists:trip_routes,id'],
      'current_status' => ['required', 'string'],
      'departure_date' => ['nullable', 'date_format:Y-m-d h:i A'],
      'estimated_delivery_date' => ['nullable', 'date_format:Y-m-d h:i A'],
    ]);
    if ($validator->fails()) {
      return response()->json(
        [
          'message' => __('The given data was invalid'),
          'errors' => $validator->errors(),
        ],
        422
      );
    }

    // Generate random unique tracking number
    $trackingNo = Str::random(12);
    while (Trip::where('tracking_no', $trackingNo)->exists()) {
      // Regenerate if the generated tracking number already exists
      $trackingNo = Str::random(12);
    }

    // Convert date strings to Carbon instances
    $departureDate = null;
    $estimatedDeliveryDate = null;
    if ($request->input('departure_date')) {
      $departureDate = Carbon::parse($request->input('departure_date'));
    }
    if ($request->input('estimated_delivery_date')) {
      $estimatedDeliveryDate = Carbon::parse($request->input('estimated_delivery_date'));
    }

    // Create the trip
    $trip = Trip::create([
      'trip_route_id' => $request->trip_route_id,
      'current_status' => $request->input('current_status'),
      'current_route_leg' => 0,
      'departure_date' => $departureDate,
      'estimated_delivery_date' => $estimatedDeliveryDate,
      'tracking_no' => $trackingNo,
      'created_by' => auth()->user()->id,
    ]);

    // Return a response as needed
    return response()->json(['message' => __('Trip created successfully')], 200);
  }

  /**
   * Display the specified resource.
   */
  public function show(Trip $trip)
  {
    $trip = $trip->with(['tripRoute', 'tripHistory'])->findOrFail($trip->id);
    $currentLeg = $trip->current_route_leg;
    $currentLegData = $trip->tripRoute->legs[$currentLeg];
    $trip->currentLegData = $currentLegData;
    // return $trip;
    return view('trips.show')->with('trip', $trip);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Trip $trip)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validator = Validator::make($request->all(), [
      'trip_route_id' => ['required', 'string', 'exists:trip_routes,id'],
      'current_status' => ['required', 'string'],
      'departure_date' => ['nullable'],
      'estimated_delivery_date' => ['nullable'],
    ]);
    if ($validator->fails()) {
      return response()->json(
        [
          'message' => __('The given data was invalid'),
          'errors' => $validator->errors(),
        ],
        422
      );
    }
    // Find the existing Trip by ID
    $trip = Trip::findOrFail($id);

    // Convert date strings to Carbon instances
    $departureDate = $trip->departure_date;
    $estimatedDeliveryDate = $trip->estimated_delivery_date;
    if ($request->input('departure_date')) {
      $departureDate = Carbon::parse($request->input('departure_date'));
    }
    if ($request->input('estimated_delivery_date')) {
      $estimatedDeliveryDate = Carbon::parse($request->input('estimated_delivery_date'));
    }

    // Update the attributes
    $trip->departure_date = $departureDate;
    $trip->estimated_delivery_date = $estimatedDeliveryDate;
    $trip->trip_route_id = $request->input('trip_route_id');
    $trip->current_status = $request->input('current_status');
    $trip->updated_by = auth()->user()->id;

    // Save the updated instance to the database
    $trip->save();

    return response()->json(['message' => __('Trip updated successfully')], 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $trip = Trip::find($id);
    $trip->deleted_by = auth()->user()->id;

    if ($trip) {
      $trip->delete();
      $trip->save();

      return response()->json(['message' => __('Trip deleted successfully')]);
    }

    return response()->json(['message' => __('Trip Route not found')], 404);
  }

  public function get_trips()
    {
        $trips = Trip::orderBy('id', 'DESC')->get();
        return Datatables::of($trips)
        ->addColumn('status', function ($trips) {
        return __($trips->current_status);
         })
         ->addColumn('shipmentsCount', function ($trip) {
            return $trip->shipments->count();
        })
        ->make(true);
    }

    public function get_trip_shipments($id){
        $shipments = Shipment::select(
            'shipments.*',
            DB::raw('(CASE WHEN trip_shipments.trip_id = ' . intval($id) . ' THEN 1 ELSE 0 END) AS selected')
        )
        ->leftJoin('trip_shipments', 'shipments.id', '=', 'trip_shipments.shipment_id')
        ->where(function ($query) use ($id) {
            $query->whereNull('trip_shipments.shipment_id')
                ->orWhere('trip_shipments.trip_id', $id);
        })
        ->get();
        return Datatables::of($shipments)
        ->addColumn('customerName', function ($shipment) {
        return $shipment->customer ? $shipment->customer->first_name.' '.$shipment->customer->last_name : 'N/A';
         })
        ->addColumn('status', function ($trips) {
        return __($trips->current_status);
        })
        ->make(true);
    }
}