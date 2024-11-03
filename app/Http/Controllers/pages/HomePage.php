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
    if ($user->hasRole('Customer')) {
      $customerData = Customer::where('user_id', $user->id)->first();
      $shipments = Shipment::where('customer_id', $customerData->id)->count();
      $payments = Shipment::withCount('payment')->where('customer_id', $customerData->id)
        ->get()
        ->sum('payment_count');
    } else {
      $shipments = Shipment::count();
      $payments = Payment::count();
    }
    $customers = Customer::count();
    $trips = Trip::count();
    $tripRoutes = TripRoute::count();
    $users = User::count();


    return view('content.pages.home', compact('customers', 'shipments', 'trips', 'tripRoutes', 'users', 'payments'));
  }
}
