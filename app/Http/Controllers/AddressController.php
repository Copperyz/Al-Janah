<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::paginate(10);
        $citiesList = City::with('country')->paginate(10);
        $cities = config('constants.cities');
        $countries = Country::all();
        return view('addresses.index', compact('cities', 'branches', 'citiesList', 'countries'));
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
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
          ]);
          if ($validator->fails()) {
            return response()->json([
              'message' => __('The given data was invalid'),
              'errors' => $validator->errors()
            ], 422);
          }
        try {
            $branch = new Branch();
            $branch->city_id = $request->city_id;
            $branch->name = $request->name;
            $branch->created_by = auth()->id();
            $branch->save();

            return response()->json(['message' => __('Address added successfully')],  200);

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
        $address = Branch::with('city')->find($id);

        if (!$address) {
            return response()->json(['error' => 'Address not found'], 404);
        }

        return response()->json(['address' => $address]);
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
        // Validate the request
        $validator = Validator::make($request->all(), [
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
        return response()->json([
            'message' => __('The given data was invalid'),
            'errors' => $validator->errors()
        ], 422);
        }

        // Find the role by ID
        $branch = Branch::findOrFail($id);

        // Update the role name
        $branch->update(['name' => $request->input('name')]);
        $branch->update(['city_id' => $request->input('city_id')]);

        return response()->json(['message' => __('Address updated successfully')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
