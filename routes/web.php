<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\Settings;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Users;
use App\Http\Controllers\RolesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main Page Route
// Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// authentication
// Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
// Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');

Route::middleware(['guest'])->group(function () {
  Route::get('/login', function () {
    return view('auth.login');
  })->name('login');
  Route::post('/login', [AuthController::class, 'Login'])->name('Login');
  Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
  Route::post('/register', [AuthController::class, 'Register'])->name('register');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/', [HomePage::class, 'index'])->name('pages-home');
  Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');

  // Settings
  Route::get('/change-locale/{locale}', [Settings::class, 'setLocale'])->name('changeLocale');

  // Users
  Route::resource('users', Users::class);
  Route::get('get-users', [Users::class, 'get_users'])->name('get-users');

  // Roles
  Route::resource('roles', RolesController::class);

});