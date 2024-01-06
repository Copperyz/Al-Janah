<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserConfirmationEmail;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use PhpParser\Node\Expr\FuncCall;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
  public function Login(Request $request)
  {
    // return $request;
    // Validate the input fields
    $request->validate([
      'email' => 'required|email', // You can add additional validation rules for phone if needed
      'password' => 'required|string|min:6|max:30',
    ]);
    // Attempt to log in using Laravel's built-in authentication features
    $user = User::where('email', $request->email)->first();
    if ($user && $user->block == 0 && Hash::check($request->password, $user->password)) {
      Auth::login($user);
      return redirect()->intended();
    } else {
      // If login attempt fails, throw a ValidationException with the custom error message
      throw ValidationException::withMessages([
        'email' => [Lang::get('auth.failed')],
      ])->redirectTo(route('login'));
    }
  }

  public function showLogin(Request $request)
  {
    $userLocale = $request->session()->get('locale'); // Get current locale
    $request->session()->flush();
    $request->session()->regenerate();
    $request->session()->put('locale', $userLocale); // Store in session
    return view('auth.login');
  }

  public function showRegister()
  {
    return view('auth.register');
  }
  public function Register(Request $request)
  {
    Validator::make($request->all(), [
      'name' => ['required', 'string', 'min:2', 'max:30'],
      'email' => ['required', 'email', Rule::unique(User::class)],
      'password' => ['required', 'string', 'min:8', 'max:30', 'confirmed'],
    ])->validate();
    // return $request;
    try {
      DB::transaction(function () use ($request) {
        // Hash the password
        $request['password'] = Hash::make($request['password']);
        $request['confirmation_token'] = Str::uuid();
  
        $user = User::create($request->all());

        Mail::to($user->email)->send(new UserConfirmationEmail($user));
      });
      return view('auth.verify-email')->with('email', $request->email);

    } catch (\Exception $e) {
      // Rollback the transaction in case of any errors
      // Handle the error or redirect back with an error message
      return redirect()
        ->back()
        ->with('error', 'Registration failed: ' . $e->getMessage());
    }
  }
  public function confirmAccount($token){
    $user = User::where('confirmation_token', $token)->first();
    if (!$user) {
        return redirect()->route('register')->with('error', 'Invalid confirmation token.');
    }
    try {
      $user->email_verified_at = now();
      $user->confirmation_token = null;
      $user->save();
      
      $role = Role::where('name', 'customer')->first();
      $user->assignRole($role);

      $countries = Country::all();
      $cities = City::all();
      return view('auth.complete-register')
      ->with('countries', $countries)
      ->with('cities', $cities)
      ->with('user', $user);
      
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Invalid data.');
    }
  }
  // public function test(){
  //   $countries = Country::all();
  //   $cities = City::all();
  //   return view('auth.complete-register')
  //   ->with('countries', $countries)
  //   ->with('cities', $cities);
  // }
  public function storeAccount(Request $request, $userID){

    $user = User::findOrFail($userID);

    if (!$user) {
        return redirect()->route('login')->with('error', 'Invalid confirmation token.');
    }

    DB::transaction(function() use ($request, $user){
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
      // save user;
      $user->status = 1;
      $user->save();
      //save customers;
      $customer->customer_code = $newCode;
      $customer->type = 'website';
      $customer->first_name = $request->first_name;
      $customer->last_name = $request->last_name;
      $customer->email = $user->email;
      $customer->phone = $request->phone;
      $customer->address = $request->address;
      $customer->country_id = $request->country;
      $customer->city_id = $request->city;
      $customer->status = 1;
      $customer->user_id = $user->id;
      $customer->save();

    });
    
    Auth::login($user);
    return redirect()->route('dashboard');
  }
  public function Logout(Request $request)
  {
    $userLocale = app()->getLocale(); // Get current locale
    $request->session()->flush();
    $request->session()->regenerate();
    $request->session()->put('locale', $userLocale); // Store in session
    return redirect('/');
  }
}