<?php

namespace App\Http\Controllers;

use App\Models\ParcelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ParcelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parcelTypes = ParcelType::paginate(10);
        return view('parcel_types.index', compact('parcelTypes'));
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
            'name' => 'required|string|max:255',
          ]);
          if ($validator->fails()) {
            return response()->json([
              'message' => __('The given data was invalid'),
              'errors' => $validator->errors()
            ], 422);
          }
        try {
            $parcelType = new ParcelType();
            $parcelType->name = $request->name;
            $parcelType->created_by = auth()->id();
            $parcelType->save();
            return response()->json(['message' => __('Parcel Type added successfully')],  200);

        } catch (\Throwable $th) {
            return $th;
            return response()->json(['message' => __('Something went wrong')], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parcelType = ParcelType::find($id);

        if (!$parcelType) {
            return response()->json(['error' => 'Parcel Type not found'], 404);
        }

        return response()->json(['parcelType' => $parcelType]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParcelType $parcelType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
        return response()->json([
            'message' => __('The given data was invalid'),
            'errors' => $validator->errors()
        ], 422);
        }

        $parcelType = ParcelType::findOrFail($id);

        $parcelType->update(['name' => $request->input('name')]);

        return response()->json(['message' => __('Parcel Type updated successfully')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParcelType $parcelType)
    {
        //
    }
}
