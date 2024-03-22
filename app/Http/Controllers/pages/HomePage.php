<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Shipment;
use App\Models\Trip;
use App\Models\TripRoute;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomePage extends Controller
{
  public function index()
  {
    $user = auth()->user();
    if($user->hasRole('Customer')){
      $data = Customer::with('shipments', 'country')->where('user_id', $user->id)->first();
      return view('content.pages.home')->with('customer', $data);
    }
    if($user->hasRole('Super Admin')){
        $customers = Customer::count();
        $shipments = Shipment::count();
        $trips = Trip::count();
        $tripRoutes = TripRoute::count();
        $users = User::count();
        $payments = Payment::count();

      return view('content.pages.home', compact('customers', 'shipments', 'trips', 'tripRoutes', 'users', 'payments'));
    }
    return view('content.pages.home');
  }
}
