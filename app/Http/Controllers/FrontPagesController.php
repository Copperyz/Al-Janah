<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Country;
use App\Models\GoodType;
use App\Models\TripRoute;
use App\Models\ParcelType;
use Illuminate\Http\Request;

class FrontPagesController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];

    return view('front-pages.landing-page', compact('pageConfigs'));
  }
  // public function getPrice()
  // {
  //   $pageConfigs = ['myLayout' => 'front'];
  //   return view('front-pages.pricing-page', ['pageConfigs' => $pageConfigs]);
  // }
  public function showPriceSections(Request $request)
  {
    $pageConfigs = ['myLayout' => 'front'];
    // Logic to handle form submission
    $countries = Country::all();
    $tripRoutes = TripRoute::all();
    $parcelTypes = ParcelType::all();
    $goodTypes = GoodType::all();
    $currentSection = 1;
    // Additional logic to retrieve data for the view
    $finalSection = 3; // Adjust the value based on the number of sections

    return view('front-pages.pricing-page', [
      'pageConfigs' => $pageConfigs,
      'currentSection' => $currentSection,
      'finalSection' => $finalSection,
      'countries' => $countries,
      'parcelTypes' => $parcelTypes,
      'goodTypes' => $goodTypes,
      'tripRoutes' => $tripRoutes,
    ]);
  }

  public function getPrice(Request $request)
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
// $price * $request->input('weight')
    return response()->json(['data' => 44]);
  }
}