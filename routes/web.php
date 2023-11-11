<?php

use App\Http\Controllers\Users;
use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryItemsController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

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

Route::middleware(['guest'])->group(function () {
  Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
  Route::post('/login', [AuthController::class, 'Login'])->name('Login');
  Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
  Route::post('/register', [AuthController::class, 'Register'])->name('register');
});

// Settings
Route::get('/change-locale/{locale}', [Settings::class, 'setLocale'])->name('changeLocale');

Route::middleware(['auth'])->group(function () {
  Route::get('/', [HomePage::class, 'index'])->name('pages-home');
  Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');

  // Users
  Route::get('get-users', [Users::class, 'get_users'])->name('get-users');
  Route::resource('users', Users::class);

  // Roles
  Route::resource('roles', RolesController::class);

  // Permissions
  Route::get('get-permissions', [PermissionsController::class, 'get_permissions'])->name('get-permissions');
  Route::resource('permissions', PermissionsController::class);

  //Orders
  Route::get('get-orders', [OrderController::class, 'get_orders'])->name('get-orders');
  Route::resource('orders', OrderController::class);

  //Order Items
  Route::get('get-orderItems/{id}', [OrderItemController::class, 'get_order_itmes'])->name('get-order-itmes');
  Route::resource('order-itmes', OrderItemController::class);

  //Inventory
  Route::get('get-inventories', [InventoryController::class, 'getInventories'])->name('get-inventories');
  Route::resource('inventory', InventoryController::class);
  //InventoryItems
  Route::get('get-inventoryItems', [InventoryItemsController::class, 'getInventoryItems'])->name('get-inventoryItems');
  Route::resource('InventoryItems', InventoryItemsController::class);
});
