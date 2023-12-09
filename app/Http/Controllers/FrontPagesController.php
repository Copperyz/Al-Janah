<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Country;
use App\Models\GoodType;
use App\Models\Shipment;
use App\Models\Trip;
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
  public function trackShipmentPage()
  {
    $pageConfigs = ['myLayout' => 'front'];
    return view('front-pages.track-shipment-page', ['pageConfigs' => $pageConfigs]);
  }

  public function trackShipmentData(Request $request)
  {
    try {
      $shipment = Shipment::with('shipmentHistory', 'trips')
        ->where('tracking_no', $request->tracking_number)
        ->first();
      if (!isset($shipment)) {
        return view('trips.tracking')->with('shipmentHistory', []);
      }
      $tripIds = $shipment->shipmentHistory
        ->pluck('trip_id')
        ->unique()
        ->values();
      $tripRoutes = Trip::whereIn('id', $tripIds)
        ->with('tripRoute')
        ->get()
        ->pluck('tripRoute');

      $shipmentHistory = $shipment->shipmentHistory->map(function ($history) use ($tripRoutes) {
        $history->tripRouteId = Trip::where('id', $history->trip_id)
          ->pluck('trip_route_id')
          ->first();
        return $history;
      });

      $shipmentHistory = $shipmentHistory->map(function ($history) use ($tripRoutes) {
        $matchingTripRoute = $tripRoutes->firstWhere('id', $history->tripRouteId);

        if ($matchingTripRoute) {
          $leg = $matchingTripRoute->legs[$history->route_leg];
          $history->country = $leg['country'];
          $history->type = $leg['type'];
        }

        return $history;
      });

      $shipmentHistory = $shipmentHistory
        ->groupBy('country')
        ->map(function ($groupedHistories) {
          $uniqueTripRouteIds = $groupedHistories->pluck('tripRouteId')->unique();

          if ($uniqueTripRouteIds->count() > 1) {
            // If there are multiple tripRouteIds for the same country, set type to 'Transit'
            $groupedHistories->transform(function ($history) {
              $history->type = 'Transit';
              return $history;
            });
          }
          return $groupedHistories;
        })
        ->flatten();
    } catch (\Throwable $th) {
      return $th;
    }

    return view('trips.tracking', compact('shipmentHistory', 'tripRoutes'));
  }
  public function showPriceSections(Request $request)
  {
    $pageConfigs = ['myLayout' => 'front'];
    // Logic to handle form submission
    $countries = Country::all();
    $tripRoutes = TripRoute::all();
    foreach ($tripRoutes as $tripRoute) {
            $legsCombined = '';
            foreach ($tripRoute->legs as $leg) {
                if (!empty($leg['country'])) {
                    $legsCombined .= ($legsCombined ? '. ' : '') . ' ' . __($leg['type']) . ' (' . __($leg['country']) . ') ';
                }
            }
            $tripRoute->legs_combined = $legsCombined;    
            $tripRoute->typeLocale = __($tripRoute->type); 
    }
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
    return response()->json(['data' => $price * $request->input('weight')]);
  }
}