<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Inventory;
use App\Models\InventoryItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class InventoryController extends Controller
{
  public function getInventories()
  {
    $inventories = Inventory::with('branch', 'inventoryItem')
      ->withCount('inventoryItem')
      ->get();
    return DataTables::of($inventories)
      ->addColumn('branch_name', function ($inventories) {
        return $inventories->branch->name;
      })
      ->rawColumns(['branch_name'])
      ->make(true);
  }

  public function index()
  {
    $branches = Branch::all();
    return view('inventory.index')->with('branches', $branches);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'inventoryName' => 'bail|required|unique:inventories,name|max:255',
      'branchID' => 'required|exists:branches,id',
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

    try {
      $inventory = new Inventory();
      $inventory->name = $request->inventoryName;
      $inventory->branch_id = $request->branchID;
      $inventory->created_by = auth()->id();
      $inventory->save();

      return response()->json(['message' => __('Inventory added successfully')], 200);
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
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validator = Validator::make($request->all(), [
      'name' => ['bail', 'required', Rule::unique('inventories', 'name')->ignore($id), 'max:255'],
      'branchID' => 'required|exists:branches,id',
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
    try {
      $inventory = Inventory::findOrFail($id);
      $inventory->name = $request->name;
      $inventory->branch_id = $request->branchID;
      $inventory->updated_by = auth()->id();
      $inventory->save();

      return response()->json(['message' => __('Inventory updated successfully')], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => __('Something went wrong')], 422);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      $inventory = Inventory::findOrFail($id);
      $inventory->deleted_by = auth()->id();
      $inventory->delete();
      $inventory->save();
      return response()->json(['message' => __('Inventory deleted successfully')], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => __('Something went wrong')], 422);
    }
  }
}
