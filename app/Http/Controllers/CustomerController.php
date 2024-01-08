<?php

namespace App\Http\Controllers;

use App\Mail\UserLoginCredentials;
use App\Models\Customer;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function getCustomers()
  {
    $customers = Customer::with('country', 'shipments')->get();
    return DataTables::of($customers)
      ->addColumn('customerName', function ($customer) {
        return $customer->first_name . ' ' . $customer->last_name;
      })
      ->addColumn('shipments', function ($customer) {
        return $customer->shipments->count();
      })
      ->rawColumns(['customerName', 'shipments'])
      ->make(true);
  }

  public function getShipmetns($customerID)
  {
    $shipments = Shipment::where('customer_id', $customerID)->get();
    return Datatables::of($shipments)->make(true);
  }

  public function updateCustomerData(Request $request)
  {
    $request->validate([
      'currentPassword' => 'required',
      'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user = auth()->user();
    // Check if the old password matches the one in the database
    if (!Hash::check($request->currentPassword, $user->password)) {
      return response()->json(
        [
          'message' => __('The given data was invalid'),
          'errors' => [__('The provided old password is incorrect')],
        ],
        422
      );
    }
    // Update the password
    $user =  User::findOrFail($user->id);
    $user->password = Hash::make($request->new_password);
    $user->save();

    // $user->update([
    //     'password' => Hash::make($request->new_password),
    // ]);
    return response()->json(['message' => __('Password updated successfully')]);
  }

  public function index()
  {
    //
    return view('customers.index');
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
    'first_name' => ['required', 'string', 'max:255'],
    'last_name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
    'phone' => ['required', 'string', 'max:20', 'unique:customers,phone'],
    'address' => ['required', 'string', 'max:255'],
    'country_id' => ['required', 'exists:countries,id'],
    'city_id' => ['required', 'exists:cities,id'],
  ]);

  if ($validator->fails()) {
    return response()->json(
      [
        'message' => __('The given data was invalid'),
        'errors' => $validator->errors(),
      ],
      422
    );
  }
    try {
      //code...
      DB::transaction(function () use ($request) {
          
        $customer = new Customer();
        $lastCustomer = Customer::latest()->first();
    
        if ($lastCustomer) {
          $lastCode = $lastCustomer->customer_code;
    
          // Extract the letter and number parts
          preg_match('/([A-Z]+)(\d+)/', $lastCode, $matches);
    
          $letterPart = $matches[1];
          $numberPart = intval($matches[2]);
    
          // Increment the number part or change the letter if needed
          if ($numberPart < 1000) {
            $numberPart++;
          } else {
            $letterPart = chr(ord($letterPart) + 1);
            $numberPart = 1;
          }
    
          $newCode = $letterPart . $numberPart;
        } else {
          // If no existing customers, start with A1
          $newCode = 'A1';
        }
        if($request->has('addByAdmin')){
          $user = new User();
          $user->name = $request->first_name;
          $user->email = $request->email;
          $user->password = Hash::make($request->phone);
          $user->confirmation_token = null;
          $user->save();
          $user->assignRole('customer');
          
          $customer->customer_code = $newCode;
          $customer->type = 'Local';
          $customer->first_name = $request->first_name;
          $customer->last_name = $request->last_name;
          $customer->email = $request->email;
          $customer->phone = $request->phone;
          $customer->address = $request->address;
          $customer->country_id = $request->country_id;
          $customer->city_id = $request->city_id;
          $customer->status = 1;
          $customer->user_id = $user->id;
          $customer->created_by = auth()->id();
          $customer->save();

          Mail::to($user->email)->send(new UserLoginCredentials($user));
        }
      });
      return response()->json(['message' => __('Customer added successfully')]);

    } catch (\Throwable $th) {
      return $th;
        return response()->json(['message' => __('Something went wrong')], 422);
    }

  }

  /**
   * Display the specified resource.
   */
  public function show(Customer $customer)
  {
    //
    $customer = Customer::with('shipments')->findOrFail($customer->id);

    return view('customers.show')->with('customer', $customer);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Customer $customer)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Customer $customer)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Customer $customer)
  {
    //
  }
}
