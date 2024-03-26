<?php

namespace App\Http\Controllers;

use App\Models\GoodType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GoodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goodTypes = GoodType::paginate(10);
        return view('good_types.index', compact('goodTypes'));
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
            $goodType = new GoodType();
            $goodType->name = $request->name;
            $goodType->created_by = auth()->id();
            $goodType->save();
            return response()->json(['message' => __('Good Type added successfully')],  200);

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
        $goodType = GoodType::find($id);

        if (!$goodType) {
            return response()->json(['error' => 'Good Type not found'], 404);
        }

        return response()->json(['goodType' => $goodType]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GoodType $goodType)
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

        $GoodType = GoodType::findOrFail($id);

        $GoodType->update(['name' => $request->input('name')]);

        return response()->json(['message' => __('Good Type updated successfully')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GoodType $goodType)
    {
        //
    }
}
