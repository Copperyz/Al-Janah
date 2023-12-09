<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Shipment;
use App\Models\TripShipment;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\ShipmentHistory;
use Illuminate\Support\Facades\DB;

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
  public function update(Request $request, string $id)
  {
    // Extract selected rows from the request
    $selectedRows = $request->selectedRows;
    $deSelectedRows = $request->deSelectedRows;

    $shipmentIds = collect($deSelectedRows)->pluck('id');
    InventoryItem::whereIn('shipment_id', $shipmentIds)
    ->update(['status' => 'returned']);

    // Extract the shipment IDs from the selected rows
    $shipmentIds = collect($selectedRows)->pluck('id');
    InventoryItem::whereIn('shipment_id', $shipmentIds)
    ->update(['status' => 'leftInventory']);

    // Sync the shipment IDs with the trip_shipments table
    DB::transaction(function () use ($request, $id, $shipmentIds, $deSelectedRows) {
      $trip = Trip::findOrFail($id);
      $trip->shipments()->sync($shipmentIds);

      $note = '';
      switch ($request->selectedChangeType) {
        case 'Detour':
          $note = __('The shipment route has been changed');
          break;

        case 'Cancel':
          $note = __('The shipment has been canceled');
          break;

        case 'Complete':
          $note = __('The shipment is ready for pickup');
          break;

        default:
          $note = '';
      }
      if ($deSelectedRows !== null) {
        return 'dkjkdj';
        foreach ($deSelectedRows as $key => $row) {
          $row = is_array($row) ? (object) $row : $row;

          $shipment = Shipment::findOrFail($row->id);
          $shipment->detour = $request->selectedChangeType === "Detour" ? 1 : 0;
          $shipment->updated_by = auth()->user()->id;
          $shipment->save();

          $shipmentHistory = new ShipmentHistory();
          $shipmentHistory->trip_id = $trip->id;
          $shipmentHistory->shipment_id = $row->id;
          $shipmentHistory->status = $trip->current_status;
          $shipmentHistory->change_type = $request->selectedChangeType;
          $shipmentHistory->route_leg = $trip->current_route_leg;
          $shipmentHistory->note = $note;
          $shipmentHistory->created_by = auth()->user()->id;
          $shipmentHistory->save();
        }
      }
    });
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