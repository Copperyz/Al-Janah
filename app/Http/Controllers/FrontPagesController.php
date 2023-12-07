<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\GoodType;
use App\Models\ParcelType;
use App\Models\TripRoute;
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
    dd($request);
    // Handle the form submission here if needed
    // You can update the database, perform validation, etc.

    // Redirect back to the main page or perform any other action
    return response()->json(['data' => '40']);
  }
}
