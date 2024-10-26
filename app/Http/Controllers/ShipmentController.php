<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\User;
use App\Models\GoodType;
use App\Models\Shipment;
use App\Models\Inventory;
use App\Models\TripRoute;
use App\Models\ParcelType;
use Illuminate\Support\Str;
use App\Models\ShipmentItem;
use App\Models\ShipmentHistory;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShipmentCreated;
use Illuminate\Support\Facades\Auth;


class ShipmentController extends Controller
{

    public function __construct()
    {
        // Protect only the 'edit' action with 'edit shipment' permission
        $this->middleware('permission:edit shipment')->only('edit');

        // Protect only the 'add' action with 'add shipment' permission
        $this->middleware('permission:add shipment')->only('create');

        // Protect only the 'show' action with 'show shipment' permission
        $this->middleware('permission:show shipment')->only('show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Count of all shipments
        $shipmentsCount = Shipment::count();

        // Count of all customers
        $customersCount = Customer::count();


        $deliveredCount = ShipmentHistory::whereIn('id', function($query) {
        $query->selectRaw('MAX(id)')
              ->from('shipment_histories')
              ->groupBy('shipment_id');
    })->where('status', 'Delivered')
      ->count();

    $inProgressCount = ShipmentHistory::whereIn('id', function($query) {
        $query->selectRaw('MAX(id)')
              ->from('shipment_histories')
              ->groupBy('shipment_id');
    })->where('status', '!=', 'Delivered')
      ->count();

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
        $currencies = Currency::all();
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
        return view('shipments.create', compact('customers', 'parcelTypes', 'goodTypes', 'countries', 'cities', 'tripRoutes', 'inventories', 'currencies'));
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
            'currency_id' => ['required', 'exists:currencies,id'],
            'shipmentItems' => ['required', 'array', 'min:1'],
            'shipmentItems.*.parcel_types_id' => ['required', 'exists:parcel_types,id'],
            'shipmentItems.*.good_types_id' => ['required', 'exists:good_types,id'],
            'shipmentItems.*.price' => ['required', 'numeric', 'min:0'],
            'shipmentItems.*.height' => ['required', 'numeric', 'min:0'],
            'shipmentItems.*.width' => ['required', 'numeric', 'min:0'],
            'shipmentItems.*.weight' => ['required', 'numeric', 'min:0'],
            'shipmentItems.*.length' => ['required', 'numeric', 'min:0'],
            'shipmentItems.*.quantity' => ['required', 'numeric', 'min:1'],
            // 'notes' => ['nullable', 'string'],
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
        $shipment->currency_id = $request->currency_id;
        $shipment->shipmentPrice = $request->shipmentPrice;
        $shipment->customer_id = $request->customer_id;
        $shipment->notes = $request->notes;
        $shipment->created_by = auth()->id();
        $delivery_code = strtoupper(substr(Str::random(1), 0, 1) . rand(10, 99) . substr(Str::random(1), 0, 1));
        while (Shipment::where('delivery_code', $delivery_code)->exists()) {
            // Regenerate if the generated tracking number already exists
            $delivery_code = strtoupper(substr(Str::random(1), 0, 1) . rand(10, 99) . substr(Str::random(1), 0, 1));
        }
        $shipment->delivery_code = $delivery_code;
        $tracking_no = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        while (Shipment::where('tracking_no', $tracking_no)->exists()) {
            // Regenerate if the generated tracking number already exists
            $tracking_no = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
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
                    $inventoryItems->aisle = $request->shipmentItems[$i]['aisle'];
                    $inventoryItems->shelfNumber = $request->shipmentItems[$i]['shelfNumber'];
                    $inventoryItems->row = $request->shipmentItems[$i]['row'];
                    $inventoryItems->created_by = auth()->id();
                    $inventoryItems->save();
                }
        }

        $customer = Customer::where('id', $shipment->customer_id)->first();
        $user = User::where('id', $customer->user_id)->first();
        Mail::to($user->email)->send(new ShipmentCreated($user));
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
        $payment = Payment::where('shipment_id', $shipment->id)->first();
        $tripRoutes = TripRoute::all();
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
        return view('shipments.show', compact('shipment', 'parcelTypes', 'goodTypes', 'payment','tripRoutes'));
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
        $tripRoutes = TripRoute::all();
        $currencies = Currency::all();
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
        return view('shipments.edit', compact('shipment', 'customers', 'parcelTypes', 'goodTypes', 'tripRoutes', 'currencies'));
    }

    
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date_format:Y-m-d h:i A'],
            'amount' => ['required', 'numeric'],
            'currency_id' => ['required', 'exists:currencies,id'],
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
        $shipment->currency_id = $request->currency_id;
        $shipment->currency_id = $request->currency_id;
        $shipment->notes = $request->notes;
        $shipment->updated_by = auth()->id();
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
            $shipment->deleted_by = auth()->id();
            $shipment->save();
            $shipment->delete();

            return response()->json(['message' => __('Shipment deleted successfully')]);
        }

        return response()->json(['message' => __('Item not found')], 404);
    }

    // public function get_shipments()
    // {
    //     $user = Auth::user();
    //     $roles = $user->getRoleNames();

    //     foreach ($roles as $role) {
    //         if ($role == 'Customer') {
    //             $shipments = Shipment::where('customer_id', $user->customer->id)->orderBy('id', 'DESC')->get();
    //         }
    //         else {
    //             $shipments = Shipment::orderBy('id', 'DESC')->get();
    //         }
    //     }
      
    //     foreach ($shipments as $shipment) {
    //         $shipment->customerName = $shipment->customer ? $shipment->customer->first_name.' '.$shipment->customer->last_name : 'N/A';
    //         $shipment->totalAmount = number_format($shipment->amount + $shipment->shipmentPrice, 2).' '.($shipment->currency->symbol ?? '$');
    //         $shipment->paymentStatus = $shipment->payment ? '<span class="badge bg-label-success">'.__($shipment->payment->status).'</span>' :  '<span class="badge bg-label-danger">'.__('Unpaid').'</span>';
    //         $shipment->inventoryStatus =  InventoryItem::where('shipment_id', $shipment->id)->pluck('status')->first() ? '<span class="badge bg-label-info">'.__(InventoryItem::where('shipment_id', $shipment->id)->pluck('status')->first()).'</span>' :'<span class="badge bg-label-warning">'. __('Unallocated').'</span>';
    //     }
    //     return Datatables::of($shipments)
    //     ->rawColumns(['paymentStatus', 'inventoryStatus', 'totalAmount', 'delivery_code'])
    //     ->make(true);
    // }

    public function get_shipments()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();

        // Check role and filter shipments accordingly
        if ($roles->contains('Customer')) {
            $shipmentsQuery = Shipment::with(['customer', 'currency', 'payment'])->where('customer_id', $user->customer->id)->orderBy('id', 'DESC');
        } else {
            $shipmentsQuery = Shipment::with(['customer', 'currency', 'payment', 'trips'])->orderBy('id', 'DESC');
        }
        

        // Use DataTables for server-side processing
        return Datatables::of($shipmentsQuery)
            ->addColumn('customerName', function($shipment) {
                return $shipment->customer ? $shipment->customer->first_name . ' ' . $shipment->customer->last_name : 'N/A';
            })
            ->addColumn('totalAmount', function($shipment) {
                return number_format($shipment->amount + $shipment->shipmentPrice, 2) . ' ' . ($shipment->currency->symbol ?? '$');
            })
            ->addColumn('paymentStatus', function($shipment) {
                return $shipment->payment ? '<span class="badge bg-label-success">' . __($shipment->payment->status) . '</span>' : '<span class="badge bg-label-danger">' . __('Unpaid') . '</span>';
            })
            ->addColumn('inventoryStatus', function($shipment) {
                $inventoryStatus = InventoryItem::where('shipment_id', $shipment->id)->pluck('status')->first();
                return $inventoryStatus ? '<span class="badge bg-label-info">' . __($inventoryStatus) . '</span>' : '<span class="badge bg-label-warning">' . __('Unallocated') . '</span>';
            })
            ->addColumn('shipmentRoute', function($shipment) {
                $tripRoute = TripRoute::find($shipment->trips[0]->trip_route_id)->first();
                $legsCombined = '';
                foreach ($tripRoute->legs as $leg) {
                    if (!empty($leg['country'])) {
                        $legsCombined .= ($legsCombined ? '. ' : '') . ' ' . __($leg['type']) . ' (' . __($leg['country']) . ') ';
                    }
                }
                return $legsCombined;
            })
            ->addColumn('options', function ($shipment) {
                $options = '';
    
                // Check if the authenticated user has permission to edit the user
                if (auth()->user()->can('edit shipment')) {
                    $options .= '<a href="./shipments/'.$shipment->id.'/edit" class="btn btn-xs btn-info me-2"><i class="ti ti-edit ti-sm"></i></a>';
                }
    
                // Check if the authenticated user has permission to delete the user
                if (auth()->user()->can('delete shipment')) {
                    $options .= '<button class="btn btn-xs btn-danger me-2 delete-record"><i class="ti ti-trash ti-sm"></i></button>';
                }
    
                return $options;
            })
            ->rawColumns(['paymentStatus', 'inventoryStatus', 'totalAmount', 'options'])
            ->make(true);
    }
}