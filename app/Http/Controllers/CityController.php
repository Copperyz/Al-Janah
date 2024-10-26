<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citiesList = City::with('country')->paginate(10);
        $countries = Country::all();
        $cities = config('constants.cities');
        return view('cities.index', compact('citiesList', 'cities', 'countries'));
    }

    public function getCitiesByCountry($countryID)
    {
      $cities = City::where('country_id', $countryID)->get();
  
      return response()->json($cities);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'city' => 'bail|required|unique:cities,name',
            'country' => 'required',
          ]);
          if ($validator->fails()) {
            return response()->json([
              'message' => __('The given data was invalid'),
              'errors' => $validator->errors()
            ], 422);
          }
        try {
            $city = new City();
            $city->name = $request->city;
            $city->country_id = $request->country;
            $city->created_by = auth()->id();
            $city->save();

            return response()->json(['message' => __('City added successfully')],  200);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
