<?php

use App\Http\Controllers\Users;
use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontPagesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryItemsController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentHistoryController;
use App\Http\Controllers\ShipmentItemController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripHistoryController;
use App\Http\Controllers\TripRouteController;
use App\Http\Controllers\TripShipmentController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use Spatie\Permission\Contracts\Role;

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
// Front Pages
Route::get('/', [FrontPagesController::class, 'index'])->name('landing-page');
Route::get('/shipment-price', [FrontPagesController::class, 'showPriceSections'])->name('shipment-price');
Route::post('/shipment/price-submit', [FrontPagesController::class, 'getPrice'])->name('shipment.get.price');
Route::get('track-shipment', [FrontPagesController::class, 'trackShipmentPage'])->name('track-shipment');
Route::post('track-shipment-data', [FrontPagesController::class, 'trackShipmentData'])->name('track-shipment-data');
// Route::get('/test', [AuthController::class, 'test'])->name('test');

Route::middleware(['guest'])->group(function () {
  Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
  Route::post('/login', [AuthController::class, 'Login'])->name('Login');
  Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
  Route::post('/register', [AuthController::class, 'Register'])->name('register');
  Route::get('/confirm-account/{token}', [AuthController::class, 'confirmAccount'])->name('confirm-account');
  Route::post('store-account/{id}', [AuthController::class, 'storeAccount'])->name('store-account');
});

// Settings
Route::get('/change-locale/{locale}', [Settings::class, 'setLocale'])->name('changeLocale');
Route::middleware(['auth'])->group(function () {
  Route::get('dashboard', [HomePage::class, 'index'])->name('dashboard');
  Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');

  // Users
  Route::get('get-users', [Users::class, 'get_users'])->name('get-users');
  Route::resource('users', Users::class);

  // Roles
  Route::resource('roles', RolesController::class);

  // Permissions
  Route::get('get-permissions', [PermissionsController::class, 'get_permissions'])->name('get-permissions');
  Route::resource('permissions', PermissionsController::class);

  // Shipments
  Route::get('get-shipments', [ShipmentController::class, 'get_shipments'])->name('get-shipments');
  Route::resource('shipments', ShipmentController::class);

  // Shipment Items
  Route::get('get-shipmentItems/{id}', [ShipmentItemController::class, 'get_shipment_itmes'])->name(
    'get-shipment-itmes'
  );
  Route::post('add-shipmentItem/{id}', [ShipmentItemController::class, 'add_shipment_item'])->name('add-shipment-item');
  Route::resource('shipment-itmes', ShipmentItemController::class);

  // Shipment history
  Route::resource('shipment-history', ShipmentHistoryController::class);

  // Trips
  Route::get('get-trips', [TripController::class, 'get_trips'])->name('get-trips');
  Route::get('get-trip-shipments/{id}', [TripController::class, 'get_trip_shipments'])->name('get-trip-shipments');
  Route::get('tracking/{id}', [TripController::class, 'tracking'])->name('tracking');
  Route::resource('trips', TripController::class);

  // Trip Shipment
  Route::resource('trip_shipments', TripShipmentController::class);

  // Trips Routes
  Route::get('get-trip-routes', [TripRouteController::class, 'get_trip_routes'])->name('get-trip-routes');
  Route::resource('trip_routes', TripRouteController::class);

  // Trips Routes
  // Route::get('get-trip-routes', [TripRouteController::class, 'get_trip_routes'])->name('get-trip-routes');
  Route::resource('trip-history', TripHistoryController::class);

  //Inventory
  Route::get('get-inventories', [InventoryController::class, 'getInventories'])->name('get-inventories');
  Route::resource('inventory', InventoryController::class);
  //InventoryItems
  Route::get('get-inventoryItems', [InventoryItemsController::class, 'getInventoryItems'])->name('get-inventoryItems');
  Route::resource('inventoryItems', InventoryItemsController::class);

  // Prices
  Route::get('get-prices', [PriceController::class, 'get_prices'])->name('get-prices');
  Route::get('get-price', [PriceController::class, 'get_price'])->name('get-price');
  Route::resource('prices', PriceController::class);
  // Customers
  Route::get('customers-all', [CustomerController::class, 'getCustomers'])->name('customers.all');
  Route::get('customers-shipments/{id}', [CustomerController::class, 'getShipmetns'])->name('customers.shipments');
  Route::post('customer-update', [CustomerController::class, 'updateCustomerData'])->name('customer.updateData');
  Route::resource('customers', CustomerController::class);

  // Payments
  Route::resource('payments', PaymentController::class);
});