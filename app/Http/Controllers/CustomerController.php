<?php

namespace App\Http\Controllers;

use App\Mail\UserLoginCredentials;
use App\Models\CashBalance;
use App\Models\City;
use App\Models\Country;
use App\Models\Coupons;
use App\Models\Customer;
use App\Models\Shipment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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

  public function addCashBalance(Request $request, $customerID)
  {
    $validator = Validator::make($request->all(), [
      'balance' => ['required', 'numeric'],
    ]);
    if ($validator->fails()) {
      return response()->json([
        'message' => __('The given data was invalid'),
        'errors' => $validator->errors()
      ], 422);
    }
    try {
      DB::transaction(function () use ($request, $customerID) {
        $cashBalance = new CashBalance();
        $cashBalance->customer_id =  $customerID;
        $cashBalance->amount =  $request->balance;
        $cashBalance->created_by = auth()->id();
        $cashBalance->save();

        $customer = Customer::findOrfail($customerID);
        $customer->totalAmountIncrease($cashBalance->amount);
        // $customer->total_amount = $customer->total_amount + $cashBalance->amount;
        // $customer->updated_by = auth()->id();
        // $customer->save();
      });

      return response()->json(['message' => __('Cash Balance added successfully')], 200);
    } catch (\Throwable $th) {
      return response()->json(['message' => __('Something went wrong')], 422);
    }
  }
  public function addCoupon(Request $request, $customerID)
  {
    $validator = Validator::make($request->all(), [
      'coupon' => ['required', 'numeric'],
      'expired_date' => ['required', 'date'],
    ]);
    if ($validator->fails()) {
      return response()->json([
        'message' => __('The given data was invalid'),
        'errors' => $validator->errors()
      ], 422);
    }
    try {
      DB::transaction(function () use ($request, $customerID) {
        $couponCode = Str::random(6);
        while (Coupons::where('code', $couponCode)->where('used', 0)->exists()) {
          // Regenerate if the generated tracking number already exists
          $couponCode = Str::random(6);
        }
        // Convert the date string to a Carbon instance
        $date = Carbon::parse($request->expired_date);
        $coupon = new Coupons();
        $coupon->customer_id =  $customerID;
        $coupon->amount =  $request->coupon;
        $coupon->expiry_date =  $date;
        $coupon->code = $couponCode;
        $coupon->created_by = auth()->id();
        $coupon->save();
      });
      return response()->json(['message' => __('Coupon added successfully')], 200);
    } catch (\Throwable $th) {
      return $th;
      return response()->json(['message' => __('Something went wrong')], 422);
    }
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
  public function changeDefaultAddress($addressID)
  {
    $customer = auth()->user()->customer;
    $address = $customer->addresses()->findOrFail($addressID);
    if($address->is_default){
      return;
    }
    DB::transaction(function() use ($customer, $address){
      //rest all addresss to not default
      $customer->addresses()->update(['is_default' => 0]);

      $address->update(['is_default' => 1]);
    });
    return response()->json(['message' => __('Default address updated successfully')]);
  }
  public function storeAddress(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'address_type' => ['required', 'string', 'max:255'],
      'address_line' => ['required', 'string', 'max:255'],
      'city' => ['required', 'exists:cities,id'],
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

      $customer = auth()->user()->customer;
      $isDefalut = $request->address_switch ? 1 : 0;
      $customer->addresses()->update(['is_default' => 0]);
      $customer->addresses()->create([
            'type' => $request->address_type,
            'address_line' => $request->address_line,
            'city_id' => $request->city,
            'is_default' => $isDefalut,
      ]);
      return response()->json(['message' => __('Address Added successfully')]);
    } catch (\Throwable $th) {
      return response()->json(['message' => __('Something went wrong')], 422);
    }
  }
  public function updateAddress(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'address_type' => ['required', 'string', 'max:255'],
      'address_line' => ['required', 'string', 'max:255'],
      'city' => ['required', 'exists:cities,id'],
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

      $customer = auth()->user()->customer;
      $isDefalut = $request->address_switch ? 1 : 0;
      $customer->addresses()->update(['is_default' => 0]);
      $customer->addresses()->update([
            'type' => $request->address_type,
            'address_line' => $request->address_line,
            'city_id' => $request->city,
            'is_default' => $isDefalut,
      ]);
      return response()->json(['message' => __('Address Updated successfully')]);
    } catch (\Throwable $th) {
      return response()->json(['message' => __('Something went wrong')], 422);
    }
  }

  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'first_name' => ['required', 'string', 'max:255'],
      'last_name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
      'phone' => ['required', 'string', 'max:20', 'unique:customers,phone'],
      'address_type' => ['required', 'string', 'max:255'],
      'address_line' => ['required', 'string', 'max:255'],
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
        
          $user = new User();
          $user->name = $request->first_name;
          $user->email = $request->email;
          $user->password = Hash::make($request->phone);
          $user->confirmation_token = null;
          $user->save();
          $user->assignRole('Customer');

          $customer->customer_code = $newCode;
          $customer->type = 'Local';
          $customer->first_name = $request->first_name;
          $customer->last_name = $request->last_name;
          $customer->email = $request->email;
          $customer->phone = $request->phone;
          // $customer->address = $request->address;
          $customer->country_id = $request->country_id;
          $customer->city_id = $request->city_id;
          $customer->status = 1;
          $customer->user_id = $user->id;
          $customer->created_by = auth()->id();
          $customer->save();

          $customer->addresses()->create([
            'type' => $request->address_type,
            'address_line' => $request->address_line,
            'city_id' => $request->city_id,
            'is_default' => 1,
          ]);

          Mail::to($user->email)->send(new UserLoginCredentials($user));
        
      });
      return response()->json(['message' => __('Customer added successfully')]);
    } catch (\Throwable $th) {
      // dd($th);
      return response()->json(['message' => __('Something went wrong')], 422);
    }
  }

  /**
   * Display the specified resource.
   */
  public function showProfile()
  {
    $user = auth()->user();
    $customer = Customer::with('shipments', 'country', 'cashBalance', 'coupons','addresses')
    ->where('user_id', $user->id)->first();
    $countries = Country::all();
    return view('customers.show')->with('customer', $customer)->with('countries', $countries);
  }
  public function show(Customer $customer)
  {
    
      $customer = Customer::with('shipments', 'country', 'cashBalance', 'coupons')->findOrFail($customer->id);
      $countries = Country::all();
    return view('customers.show')->with('customer', $customer)->with('countries', $countries);
  }

  public function edit(Customer $customer)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Customer $customer)
  {
    try {
      $validator = Validator::make($request->all(), [
        'first_name'     => 'required|string|min:3|max:30',
        'last_name'     => 'required|string|min:3|max:30',
        'phone'     => [
          'required',
          'string',
          'max:20',
          Rule::unique('customers', 'phone')->ignore($customer->id, 'id'),
        ],
        'email'    => [
          'nullable',
          'email',
          Rule::unique('users', 'email')->ignore($customer->user->id, 'id'),
          Rule::unique('customers', 'email')->ignore($customer->id, 'id'),
        ],
      ]);
      if ($validator->fails()) {
        return response()->json([
          'message' => __('The given data was invalid'),
          'errors' => $validator->errors()
        ], 422);
      }
      DB::transaction(function () use ($request, $customer) {
        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        $customer->user->update([
            'name' => $request->first_name. ' '. $request->last_name,
            'email' => $request->email,
        ]);
      
          
      });

      return response()->json(['message' => __('User updated successfully')], 200);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'message' => __('The given data was invalid'),
        'errors' => [__('User not found')]
      ], 404);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Customer $customer)
  {
    //
  }
}
