<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countriesList = Country::paginate(10);
        $countries = config('constants.countries');
        return view('countries.index', compact('countriesList', 'countries'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'bail|required|unique:countries,country_code',
          ]);
          if ($validator->fails()) {
            return response()->json([
              'message' => __('The given data was invalid'),
              'errors' => $validator->errors()
            ], 422);
          }
        try {
            $countryName = config('constants.countries')[$request->country];
            if(empty($countryName)){
                return response()->json(['message' => __('invalid Country')], 422);

            }
            $country = new Country();
            $country->name = $countryName;
            $country->country_code = $request->country;
            $country->created_by = auth()->id();
            $country->save();

            return response()->json(['message' => __('Country added successfully')],  200);

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
