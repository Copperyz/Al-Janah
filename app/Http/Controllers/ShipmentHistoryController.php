<?php

namespace App\Http\Controllers;

use App\Models\ShipmentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShipmentHistoryController extends Controller
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
        $shipmentHistory = new ShipmentHistory();
        $shipmentHistory->trip_id = $request->trip_id;
        $shipmentHistory->shipment_id = $request->shipment_id;
        $shipmentHistory->status = $request->status;
        $shipmentHistory->change_type = $request->changeType;
        $shipmentHistory->route_leg = $request->currentLeg;
        $shipmentHistory->note = $request->note;
        $shipmentHistory->created_by = auth()->user()->id;
        $shipmentHistory->save();
      });

      return response()->json(['message' => __('Shipment Status Changed successfully')], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => $th], 422);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(ShipmentHistory $shipmentHistory)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(ShipmentHistory $shipmentHistory)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, ShipmentHistory $shipmentHistory)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(ShipmentHistory $shipmentHistory)
  {
    //
  }
}
