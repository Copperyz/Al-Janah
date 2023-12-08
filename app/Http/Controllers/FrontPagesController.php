<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\GoodType;
use App\Models\ParcelType;
use App\Models\Shipment;
use App\Models\Trip;
use App\Models\TripRoute;
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
    // dd($request);
    // Handle the form submission here if needed
    // You can update the database, perform validation, etc.

    // Redirect back to the main page or perform any other action
    return response()->json(['data' => '40']);
  }
}
