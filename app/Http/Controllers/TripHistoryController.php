<?php

namespace App\Http\Controllers;

use App\Models\ShipmentHistory;
use App\Models\Trip;
use App\Models\TripHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TripHistoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
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
    try {
      $validator = Validator::make($request->all(), [
        'trip_id' => 'required',
        'status' => 'required',
        'currentLeg' => 'required',
        // 'note' => 'required',
        // Add a custom validation rule for uniqueness based on multiple columns
        'trip_id' => [
          'required',
          Rule::unique('trip_histories')->where(function ($query) use ($request) {
            return $query
              ->where('trip_id', $request->trip_id)
              ->where('status', $request->status)
              ->where('route_leg', $request->currentLeg);
          }),
        ],
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

      DB::transaction(function () use ($request) {
        $tripHistory = new TripHistory();
        $tripHistory->trip_id = $request->trip_id;
        $tripHistory->status = $request->status;
        $tripHistory->route_leg = $request->currentLeg;
        $tripHistory->note = $request->note;
        $tripHistory->created_by = auth()->user()->id;
        $tripHistory->save();

        $trip = Trip::with('shipments')->findOrFail($request->trip_id);
        $trip->current_status = $request->status;
        $trip->current_route_leg = $request->currentLeg;
        $trip->updated_by = auth()->user()->id;
        $trip->save();

        foreach ($trip->shipments as $key => $shipment) {
          $shipmentHistory = new ShipmentHistory();
          $shipmentHistory->trip_id = $trip->id;
          $shipmentHistory->shipment_id = $shipment->id;
          $shipmentHistory->status = $request->status;
          $shipmentHistory->change_type = $shipment->detour == 1 ? 'Detour' : 'Initial';
          $shipmentHistory->route_leg = $request->currentLeg;
          $shipmentHistory->note = $request->note;
          $shipmentHistory->created_by = auth()->user()->id;
          $shipmentHistory->save();
        }
      });

      return response()->json(['message' => __('Trip Status Changed successfully')], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 422);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(TripHistory $tripHistory)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(TripHistory $tripHistory)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, TripHistory $tripHistory)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(TripHistory $tripHistory)
  {
    //
  }
}
