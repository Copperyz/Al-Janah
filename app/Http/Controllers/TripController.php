<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trip;
use App\Models\Customer;
use App\Models\Shipment;
use App\Models\TripRoute;
use App\Models\TripHistory;
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

    $deliveredCount = TripHistory::whereIn('id', function($query) {
        $query->selectRaw('MAX(id)')
              ->from('trip_histories')
              ->groupBy('trip_id');
    })->where('status', 'Delivered')
      ->count();

    $inProgressCount = TripHistory::whereIn('id', function($query) {
        $query->selectRaw('MAX(id)')
              ->from('trip_histories')
              ->groupBy('trip_id');
    })->where('status', '!=', 'Delivered')
      ->count();

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
      // 'current_status' => ['required', 'string'],
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
      // 'current_status' => $request->input('current_status'),
      'current_status' => 'In Preparation',
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
      // 'current_status' => ['required', 'string'],
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
    // $trip->current_status = $request->input('current_status');
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
      ->addColumn('options', function ($trip) {
          $options = '<div class="text-xxl-center">';
          $options .= '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>';
          $options .= '<div class="dropdown-menu dropdown-menu-end m-0">';

          if (auth()->user()->can('show trip')) {
              $options .= '<a href="./trips/' . $trip->id . '" class="dropdown-item">' .
                          '<i class="ti ti-eye me-2"></i>' . __('Track') . '</a>';
          }

          if (auth()->user()->can('show trip shipments')) {
              $options .= '<a href="javascript:;" class="dropdown-item showTripShipment" data-bs-target="#showTripShipmentModal" data-bs-toggle="modal" data-bs-dismiss="modal">' .
                          '<i class="ti ti-package me-2"></i>' . __('Show Shipments') . '</a>';
          }

          if (auth()->user()->can('edit trip')) {
              $options .= '<a href="javascript:;" class="dropdown-item editTrip" data-bs-target="#editTripModal" data-bs-toggle="modal" data-bs-dismiss="modal">' .
                          '<i class="ti ti-edit me-2"></i>' . __('Edit') . '</a>';
          }

          if (auth()->user()->can('delete trip')) {
              $options .= '<a href="javascript:;" class="dropdown-item delete-record">' .
                          '<i class="ti ti-trash me-2"></i>' . __('Delete') . '</a>';
          }

          $options .= '</div></div>';

          return $options;
      })

    ->rawColumns(['options'])
      ->make(true);
  }

  public function get_trip_shipments($id)
  {
    // dd($id);
    $shipments = Shipment::select(
        'shipments.*',
        DB::raw('(CASE WHEN trip_shipments.trip_id = ' . intval($id) . ' THEN 1 ELSE 0 END) AS selected')
    )
    ->leftJoin('trip_shipments', 'shipments.id', '=', 'trip_shipments.shipment_id')
    ->where(function ($query) use ($id) {
        $query->whereNull('trip_shipments.shipment_id')
              ->orWhere('trip_shipments.trip_id', $id);
    });
    // return $shipments->trips;
    return Datatables::eloquent($shipments)
        ->addColumn('customerName', function ($shipment) {
            return $shipment->customer ? $shipment->customer->first_name . ' ' . $shipment->customer->last_name : 'N/A';
        })
        ->addColumn('status', function ($shipment) {
            return __($shipment->current_status);
        })
        ->rawColumns(['status']) // if you want to allow raw HTML for 'status'
        ->make(true);
}

  public function tracking($id)
  {
    $shipment = Shipment::with('shipmentHistory', 'trips')
      ->where('tracking_no', $id)
      ->first();

    $tripIds = $shipment->shipmentHistory
      ->pluck('trip_id')
      ->unique()
      ->values();
    $tripRoutes = Trip::whereIn('id', $tripIds)
      ->with('tripRoute')
      ->get()
      ->pluck('tripRoute');

    $shipmentHistory = $shipment->shipmentHistory->map(function ($history) use ($tripRoutes) {
      $history->tripRouteId = Trip::where('id', $history->trip_id)
        ->pluck('trip_route_id')
        ->first();
      return $history;
    });

    $shipmentHistory = $shipmentHistory->map(function ($history) use ($tripRoutes) {
      $matchingTripRoute = $tripRoutes->firstWhere('id', $history->tripRouteId);

      if ($matchingTripRoute) {
        $leg = $matchingTripRoute->legs[$history->route_leg];
        $history->country = $leg['country'];
        $history->type = $leg['type'];
      }

      return $history;
    });

    $shipmentHistory = $shipmentHistory
      ->groupBy('country')
      ->map(function ($groupedHistories) {
        $uniqueTripRouteIds = $groupedHistories->pluck('tripRouteId')->unique();

        if ($uniqueTripRouteIds->count() > 1) {
          // If there are multiple tripRouteIds for the same country, set type to 'Transit'
          $groupedHistories->transform(function ($history) {
            $history->type = 'Transit';
            return $history;
          });
        }
        return $groupedHistories;
      })
      ->flatten();

    return view('trips.tracking', compact('shipmentHistory', 'tripRoutes'));
  }
}
