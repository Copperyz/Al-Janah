<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\GoodType;
use App\Models\Shipment;
use App\Models\Inventory;
use App\Models\TripRoute;
use App\Models\ParcelType;
use Illuminate\Support\Str;
use App\Models\ShipmentItem;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipmentsCount = 0;
        $customersCount = 0;
        $deliveredCount = 0;
        $inProgressCount = 0;
        return view('shipments.index', compact('shipmentsCount', 'customersCount', 'deliveredCount', 'inProgressCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $parcelTypes = ParcelType::all();
        $goodTypes = GoodType::all();
        $countries = Country::all();
        $cities = City::all();
        $tripRoutes = TripRoute::all();
        $inventories = Inventory::all();
        foreach ($tripRoutes as $tripRoute) {
            $legsCombined = '';
            foreach ($tripRoute->legs as $leg) {
                if (!empty($leg['country'])) {
                    $legsCombined .= ($legsCombined ? '. ' : '') . ' ' . __($leg['type']) . ' (' . __($leg['country']) . ') ';
                }
            }
            $tripRoute->legs_combined = $legsCombined;    
            $tripRoute->typeLocale = __($tripRoute->type); 
        }
        return view('shipments.create', compact('customers', 'parcelTypes', 'goodTypes', 'countries', 'cities', 'tripRoutes', 'inventories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'date' => ['required', 'date_format:Y-m-d h:i A'],
            'amount' => ['required', 'numeric'],
            'customer_id' => ['required', 'exists:customers,id'],
            'shipmentItems' => ['required', 'array', 'min:1'],
            'shipmentItems.*.parcel_types_id' => ['required', 'exists:parcel_types,id'],
            'shipmentItems.*.good_types_id' => ['required', 'exists:good_types,id'],
            'shipmentItems.*.price' => ['required', 'numeric', 'min:1'],
            'shipmentItems.*.height' => ['required', 'numeric', 'min:1'],
            'shipmentItems.*.width' => ['required', 'numeric', 'min:1'],
            'shipmentItems.*.weight' => ['required', 'numeric', 'min:1'],
            'shipmentItems.*.length' => ['required', 'numeric', 'min:1'],
            'shipmentItems.*.quantity' => ['required', 'numeric', 'min:1', 'max:50'],
            'notes' => ['nullable', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }


        $shipment = new Shipment();
        $validatedDate = $request->input('date');
        $carbonDate = Carbon::createFromFormat('Y-m-d h:i A', $validatedDate);
        $mysqlDate = $carbonDate->toDateTimeString();
        $shipment->date = $mysqlDate;
        $shipment->amount = $request->amount;
        $shipment->shipmentPrice = $request->shipmentPrice;
        $shipment->customer_id = $request->customer_id;
        // $shipment->notes = $request->notes;
        $delivery_code = Str::random(12);
        while (Shipment::where('delivery_code', $delivery_code)->exists()) {
        // Regenerate if the generated tracking number already exists
        $delivery_code = Str::random(12);
        }
        $shipment->delivery_code = $delivery_code;
        $tracking_no = Str::random(12);
        while (Shipment::where('tracking_no', $tracking_no)->exists()) {
        // Regenerate if the generated tracking number already exists
        $tracking_no = Str::random(12);
        }
        $shipment->tracking_no = $tracking_no;
        $shipment->save();
        for ($i=0; $i < count($request->shipmentItems); $i++) { 
            $shipmentItem = new ShipmentItem();
                $shipmentItem->shipment_id = $shipment->id;
                $shipmentItem->parcel_types_id = $request->shipmentItems[$i]['parcel_types_id'];
                $shipmentItem->good_types_id = $request->shipmentItems[$i]['good_types_id'];
                $shipmentItem->price = $request->shipmentItems[$i]['price'];
                $shipmentItem->height = $request->shipmentItems[$i]['height'];
                $shipmentItem->width = $request->shipmentItems[$i]['width'];
                $shipmentItem->weight = $request->shipmentItems[$i]['weight'];
                $shipmentItem->length = $request->shipmentItems[$i]['length'];
                $shipmentItem->quantity = $request->shipmentItems[$i]['quantity'];
                $shipmentItem->save();
                
                if (isset($request->shipmentItems[$i]['addToInventory'])) {
                    $inventoryItems = new InventoryItem();
                    $inventoryItems->inventory_id = $request->shipmentItems[$i]['inventory_id'];
                    $inventoryItems->shipment_id = $shipment->id;
                    $inventoryItems->shipment_item_id = $shipmentItem->id;
                    $inventoryItems->name = 'Defualt';
                    $inventoryItems->status = 'inStock';
                    $inventoryItems->itemCode = 'Defualt';
                    $inventoryItems->parcel_types_id = $request->shipmentItems[$i]['parcel_types_id'];
                    $inventoryItems->height = $request->shipmentItems[$i]['height'];
                    $inventoryItems->width = $request->shipmentItems[$i]['width'];
                    $inventoryItems->size = $request->shipmentItems[$i]['weight'];
                    $inventoryItems->quantity = $request->shipmentItems[$i]['quantity'];
                    $inventoryItems->aisle = 1;
                    $inventoryItems->shelfNumber = 1;
                    $inventoryItems->row = 1;
                    $inventoryItems->created_by = auth()->id();
                    $inventoryItems->save();
                }
        }
        return response()->json([
            'message' => __('Shipment added successfully'),
            'shipment_id' => $shipment->id,
        ], 200); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipment $shipment)
    {
        $shipment = Shipment::where('id', $shipment->id)->first();
        $customers = Customer::all();
        $parcelTypes = ParcelType::all();
        $goodTypes = GoodType::all();
        return view('shipments.show', compact('shipment', 'parcelTypes', 'goodTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipment $shipment)
    {
        $customers = Customer::all();
        $parcelTypes = ParcelType::all();
        $goodTypes = GoodType::all();
        $shipment = Shipment::where('id', $shipment->id)->first();
        $shipment->orderDate = Carbon::parse($shipment->date)->format('Y-m-d\Th:i');
        return view('shipments.edit', compact('shipment', 'customers', 'parcelTypes', 'goodTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date_format:Y-m-d h:i A'],
            'amount' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }

        $shipment = Shipment::where('id',  $id)->first();
        $validatedDate = $request->input('date');
        $carbonDate = Carbon::createFromFormat('Y-m-d h:i A', $validatedDate);
        $mysqlDate = $carbonDate->toDateTimeString();
        $shipment->date = $mysqlDate;
        $shipment->amount = $request->amount;
        // $shipment->notes = $request->notes;
        $shipment->save();

        return response()->json([
            'message' => __('Shipment updated successfully'),
            'shipment_id' => $shipment->id,
        ], 200);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipmentItems = ShipmentItem::where('shipment_id', $id);

        if ($shipmentItems) {
            $shipmentItems->delete();
            $shipment = Shipment::find($id);
            $shipment->delete();

            return response()->json(['message' => __('Shipment deleted successfully')]);
        }

        return response()->json(['message' => __('Item not found')], 404);
    }

    public function get_shipments()
    {
        $shipments = Shipment::orderBy('id', 'DESC')->get();
        foreach ($shipments as $shipment) {
            $shipment->customerName = $shipment->customer ? $shipment->customer->first_name.' '.$shipment->customer->last_name : 'N/A';
            $shipment->paymentStatus = $shipment->payment ? $shipment->payment->status : 'N/A';
        }
        return Datatables::of($shipments)
        ->make(true);
    }
}