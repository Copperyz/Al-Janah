<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Country;
use App\Models\GoodType;
use App\Models\ParcelType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        $parcelTypes = ParcelType::all();
        $goodTypes = GoodType::all();
        return view('prices.index', compact('countries', 'parcelTypes', 'goodTypes'));
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
            'from_country_id' => ['required', 'exists:countries,id'],
            'to_country_id' => ['required', 'exists:countries,id'],
            'good_types_id' => ['required', 'exists:good_types,id'],
            'parcel_types_id' => ['required', 'exists:parcel_types,id'],
            'price' => ['required', 'numeric', 'min:0']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }
        $price = new Price();
        $price->from_country_id = $request->from_country_id;
        $price->to_country_id = $request->to_country_id;
        $price->parcel_types_id = $request->parcel_types_id;
        $price->good_types_id = $request->good_types_id;
        $price->price = $request->price;
        $price->save();

        return response()->json(['message' => __('Price added successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validator = Validator::make($request->all(), [
            'from_country_id' => ['required', 'exists:countries,id'],
            'to_country_id' => ['required', 'exists:countries,id'],
            'good_types_id' => ['required', 'exists:good_types,id'],
            'parcel_types_id' => ['required', 'exists:parcel_types,id'],
            'price' => ['required', 'numeric', 'min:0']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }
        $price = Price::find($id);
        $price->from_country_id = $request->from_country_id;
        $price->to_country_id = $request->to_country_id;
        $price->parcel_types_id = $request->parcel_types_id;
        $price->good_types_id = $request->good_types_id;
        $price->price = $request->price;
        $price->save();

        return response()->json(['message' => __('Price updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $price = Price::find($id);

        if ($price) {
            $price->delete();
            return response()->json(['message' => __('Price deleted successfully')]);
        }

        return response()->json(['message' => __('Price not found')], 404);
    }

    public function get_prices()
    {
        $prices = Price::orderBy('id', 'DESC')->get();
        foreach ($prices as $price) {
            $price->fromCountry = $price->fromCountry ? __($price->fromCountry->name) : 'N/A';
            $price->toCountry = $price->toCountry ? __($price->toCountry->name) : 'N/A';
            $price->goodType = $price->goodType->name;
            $price->parcelType = $price->parcelType->name;
        }
        return Datatables::of($prices)
        ->make(true);
    }

    public function get_price(Request $request)
    {
        $query = Price::query();


        if ($request->filled('parcelTypeId')) {
            $query->where('parcel_types_id', $request->input('parcelTypeId'));
        }

        if ($request->filled('goodTypeId')) {
            $query->where('good_types_id', $request->input('goodTypeId'));
        }

        if ($request->filled('from_country_id')) {
            $query->where('from_country_id', $request->input('from_country_id'));
        }

        if ($request->filled('to_country_id')) {
            $query->where('to_country_id', $request->input('to_country_id'));
        }

        $price = $query->pluck('price')->first();

        return $price;
    }
}