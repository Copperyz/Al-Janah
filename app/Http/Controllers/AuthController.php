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

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
      'password' => ['required', 'string', 'min:6', 'max:30', 'confirmed'],
    ])->validate();
    // return $request;

    DB::beginTransaction();
    try {
      // Hash the password
      $request['password'] = Hash::make($request['password']);

      $user = User::create($request->all());

      event(new Registered($user));
      DB::commit();
      // Login the user after registration
      Auth::login($user);
      // Redirect or return a response as needed
      return redirect('/');
    } catch (\Exception $e) {
      // Rollback the transaction in case of any errors
      DB::rollback();
      // Handle the error or redirect back with an error message
      return redirect()
        ->back()
        ->with('error', 'Registration failed: ' . $e->getMessage());
    }
  }

  public function Logout(Request $request)
  {
    $userLocale = app()->getLocale(); // Get current locale
    $request->session()->flush();
    $request->session()->regenerate();
    $request->session()->put('locale', $userLocale); // Store in session
    return redirect('login');
  }
}