<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Country;
use App\Models\GoodType;
use App\Models\TripRoute;
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
        $goodTypes = GoodType::all();
        return view('prices.index', compact('countries', 'goodTypes'));
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
        }
        return Datatables::of($prices)
        ->make(true);
    }

    public function get_price(Request $request)
    {
        $price = 0;
        $tripRoute = TripRoute::find($request->trip_route_id);
        $tripCountries = array_map(function ($leg) {
            return $leg['country'];
        }, $tripRoute->legs);

        for ($i = 0; $i < count($tripCountries) - 1; $i++) {
            $query = Price::query();
               
                if ($request->filled('goodTypeId')) {
                    $query->where('good_types_id', $request->input('goodTypeId'));
                }
            $fromCountry = $tripCountries[$i];
            $toCountry = $tripCountries[$i + 1];

            $price += $query->where('from_country_id', Country::where('name', $fromCountry)->pluck('id')->first())
                ->where('to_country_id', Country::where('name', $toCountry)->pluck('id')->first())
                ->pluck('price')
                ->first();
        }
        if ($request->filled('parcelTypeId') && $request->input('parcelTypeId') == 1) {
            $newPrice = $request->input('weight') * $request->input('height') * $request->input('width') / 5000;
            if($newPrice > $price * $request->input('weight'))
            $price = $newPrice;
        }

        return $price * $request->input('weight');
    }
}