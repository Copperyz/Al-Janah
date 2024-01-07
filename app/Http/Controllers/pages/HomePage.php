<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class HomePage extends Controller
{
  public function index()
  {
    $user = auth()->user();
    if($user->hasRole('customer')){
      $data = Customer::with('shipments', 'country')->where('user_id', $user->id)->first();
      return view('content.pages.home')->with('customer', $data);
    }
    return view('content.pages.home');
  }
}
