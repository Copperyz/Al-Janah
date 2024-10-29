<?php

use App\Http\Controllers\Users;
use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CouponsController;
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
use App\Http\Controllers\ShipmentOnlineController;
use App\Http\Controllers\GoodTypeController;
use App\Http\Controllers\ParcelTypeController;
use App\Http\Controllers\CurrencyController;
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
Route::get('/warehouses/{id}', [FrontPagesController::class, 'ourBranches'])->name('branches-page');
Route::get('/rates', [FrontPagesController::class, 'showPriceSections'])->name('shipment-price');
Route::post('/shipment/price-submit', [FrontPagesController::class, 'getPrice'])->name('shipment.get.price');
Route::get('tracking', [FrontPagesController::class, 'trackShipmentPage'])->name('track-shipment');
Route::post('track-shipment-data', [FrontPagesController::class, 'trackShipmentData'])->name('track-shipment-data');
// TTurk
Route::post('/handle-redirection', [ShipmentOnlineController::class, 'handleRedirection'])->name('handle.redirection');
Route::get('/test-form', [ShipmentOnlineController::class, 'testForm'])->name('test-form');

Route::post('/web-hook', [ShipmentOnlineController::class, 'webHook'])->name('web-hook');


Route::post('/shipment-online', [ShipmentOnlineController::class, 'store'])->name('shipmentOnline.store');
// Route::get('/test', [AuthController::class, 'test'])->name('test');

Route::middleware(['guest'])->group(function () {
  Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
  Route::post('/login', [AuthController::class, 'Login'])->name('Login');
  Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
  Route::post('/register', [AuthController::class, 'Register'])->name('register');
});
//customer register
Route::post('store-account/{id}', [AuthController::class, 'storeAccount'])->name('store-account');
Route::get('/confirm-account/{token}', [AuthController::class, 'confirmAccount'])->name('confirm-account');

// Settings
Route::get('/change-locale/{locale}', [Settings::class, 'setLocale'])->name('changeLocale');

// Auth
Route::middleware(['auth'])->group(function (){
  Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');
});
Route::middleware(['auth', 'complete.registration'])->group(function () {

  Route::get('dashboard', [HomePage::class, 'index'])->name('dashboard');

  // Users
  Route::group(['middleware' => ['permission:users']], function () {
    Route::get('get-users', [Users::class, 'get_users'])->name('get-users');
    Route::resource('users', Users::class);
  });


  // Roles
  Route::group(['middleware' => ['permission:roles']], function () {
    Route::resource('roles', RolesController::class);
  });

  // Permissions
  Route::group(['middleware' => ['permission:permissions']], function () {
    Route::get('get-permissions', [PermissionsController::class, 'get_permissions'])->name('get-permissions');
    Route::resource('permissions', PermissionsController::class);
  });

  Route::group(['middleware' => ['permission:shipments']], function () {
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
    });

  

    // Trips
    Route::group(['middleware' => ['permission:trips']], function () {
      Route::get('get-trips', [TripController::class, 'get_trips'])->name('get-trips');
      Route::get('get-trip-shipments/{id}', [TripController::class, 'get_trip_shipments'])->name('get-trip-shipments');
      Route::get('tracking/{id}', [TripController::class, 'tracking'])->name('tracking');
      Route::resource('trips', TripController::class);
    });


  // Trip Shipment
  Route::resource('trip_shipments', TripShipmentController::class);

  // Trips Routes
  Route::group(['middleware' => ['permission:trip_routes.index']], function () {
    Route::get('get-trip-routes', [TripRouteController::class, 'get_trip_routes'])->name('get-trip-routes');
    Route::resource('trip_routes', TripRouteController::class);
  });

  // Trips History
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

  Route::group(['middleware' => ['permission:prices.index']], function () {
    Route::resource('prices', PriceController::class);
  });

  // Customers
  Route::get('customer/profile', [CustomerController::class, 'showProfile'])->name('customer.profile');
  Route::group(['middleware' => ['permission:customers']], function () {
    Route::get('customers-all', [CustomerController::class, 'getCustomers'])->name('customers.all');
    Route::get('customers-shipments/{id}', [CustomerController::class, 'getShipmetns'])->name('customers.shipments');
    Route::post('customer-update', [CustomerController::class, 'updateCustomerData'])->name('customer.updateData');
    Route::post('customer-add-cash/{id}', [CustomerController::class, 'addCashBalance'])->name('customer.add-cash');
    Route::post('customer-add-coupon/{id}', [CustomerController::class, 'addCoupon'])->name('customer.add-coupon');
    Route::resource('customers', CustomerController::class);
  });
  

  // Payments
  Route::group(['middleware' => ['permission:payments.index']], function () {
    Route::get('get-payments', [PaymentController::class, 'getPayments'])->name('get-payments');
    Route::get('payments/refund/{id}', [PaymentController::class, 'refund'])->name('refund');
    Route::get('/payments/{id}/print', [PaymentController::class, 'print'])->name('print');
    Route::resource('payments', PaymentController::class);
  });

  //Coupon
  Route::get('coupon-verified/{id}', [CouponsController::class, 'checkCoupon'])->name('coupon.verified');

  //Countries
  Route::group(['middleware' => ['permission:countries']], function () {
    Route::resource('countries', CountryController::class);
  });

  //Cities
  Route::group(['middleware' => ['permission:cities']], function () {
    Route::resource('cities', CityController::class);
  });

  //Addresses
  Route::group(['middleware' => ['permission:addresses']], function () {
    Route::resource('addresses', AddressController::class);
  });

  //Good Types
  Route::group(['middleware' => ['permission:good_types.index']], function () {
    Route::resource('good_types', GoodTypeController::class);
  });
  
  //Parcel Types
  Route::group(['middleware' => ['permission:parcel_types.index']], function () {
    Route::resource('parcel_types', ParcelTypeController::class);
  });
  

  //Currencies
  Route::group(['middleware' => ['permission:currencies.index']], function () {
    Route::get('get-currencies', [CurrencyController::class, 'getCurrencies'])->name('get-currencies');
    Route::resource('currencies', CurrencyController::class);
  });
});