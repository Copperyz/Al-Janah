<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Order;
use App\Models\ParcelType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventoryItemsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('inventoryItem.index');
  }

  public function getInventoryItems()
  {
    $inventoryItems = InventoryItem::with('inventory')->get();

    return DataTables::of($inventoryItems)
      ->addColumn('inventoryName', function ($inventoryItems) {
        return $inventoryItems->inventory->name;
      })
      ->addColumn('actions', function ($inventoryItems) {
        return '<a class="btn btn-sm btn-icon" href="' .
          route('inventoryItems.edit', $inventoryItems->id) .
          '"><i  class="ti ti-edit" > </i></a>' .
          '<a class="btn btn-sm btn-icon delete-record" href="javascript:;">
          <i class="ti ti-trash"></i></a>';
      })
      ->rawColumns(['inventoryName', 'actions'])
      ->make(true);
  }
  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $orders = Order::all();
    $parcelTypes = ParcelType::all();
    $inventory = Inventory::all();

    return view('inventoryItem.create')
      ->with('orders', $orders)
      ->with('parcelTypes', $parcelTypes)
      ->with('inventories', $inventory);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      $inventoryItems = new InventoryItem();
      $inventoryItems->inventory_id = $request->inventoryID;
      $inventoryItems->order_id = $request->orderID;
      $inventoryItems->name = $request->productName;
      $inventoryItems->status = $request->status;
      $inventoryItems->itemCode = $request->productBarcode;
      $inventoryItems->parcel_types_id = $request->parcelType;
      $inventoryItems->height = $request->productHeight;
      $inventoryItems->width = $request->productWidth;
      $inventoryItems->size = $request->productWeight;
      $inventoryItems->quantity = $request->productQty;
      $inventoryItems->aisle = $request->productAisle;
      $inventoryItems->shelfNumber = $request->productSelf;
      $inventoryItems->row = $request->productRow;
      $inventoryItems->created_by = auth()->id();

      $inventoryItems->save();
      return response()->json(['message' => __('Item added successfully')], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => __('Something went wrong')], 422);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $inventoryItem = InventoryItem::findOrFail($id);
    $orders = Order::all();
    $parcelTypes = ParcelType::all();
    $inventory = Inventory::all();

    return view('inventoryItem.edit')
      ->with('inventoryItem', $inventoryItem)
      ->with('orders', $orders)
      ->with('parcelTypes', $parcelTypes)
      ->with('inventories', $inventory);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    try {
      $inventoryItems = InventoryItem::findOrFail($id);

      $inventoryItems->inventory_id = $request->inventoryID;
      $inventoryItems->order_id = $request->orderID;
      $inventoryItems->name = $request->productName;
      $inventoryItems->status = $request->status;
      $inventoryItems->itemCode = $request->productBarcode;
      $inventoryItems->parcel_types_id = $request->parcelType;
      $inventoryItems->height = $request->productHeight;
      $inventoryItems->width = $request->productWidth;
      $inventoryItems->size = $request->productWeight;
      $inventoryItems->quantity = $request->productQty;
      $inventoryItems->aisle = $request->productAisle;
      $inventoryItems->shelfNumber = $request->productSelf;
      $inventoryItems->row = $request->productRow;
      $inventoryItems->updated_by = auth()->id();

      $inventoryItems->save();
      response()->json(['message' => __('Item updated successfully')], 200);
    } catch (\Throwable $th) {
      response()->json(['message' => __('Something went wrong')], 422);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      $inventoryItem = InventoryItem::findOrFail($id);
      $inventoryItem->deleted_by = auth()->id();
      $inventoryItem->delete();
      $inventoryItem->save();
      return response()->json(['message' => __('Inventory Item deleted successfully')], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => __('Something went wrong')], 422);
    }
  }
}
