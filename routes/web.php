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
| Public Routes
|--------------------------------------------------------------------------
*/

// Front Pages
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', [FrontPagesController::class, 'index'])->name('landing-page');
    Route::get('/warehouses/{id}', [FrontPagesController::class, 'ourBranches'])->name('branches-page');
    Route::get('/rates', [FrontPagesController::class, 'showPriceSections'])->name('shipment-price');
    Route::get('tracking', [FrontPagesController::class, 'trackShipmentPage'])->name('track-shipment');
    
    // Shipment Related
    Route::post('/shipment/price-submit', [FrontPagesController::class, 'getPrice'])->name('shipment.get.price');
    Route::post('track-shipment-data', [FrontPagesController::class, 'trackShipmentData'])->name('track-shipment-data');
    Route::post('/shipment-online', [ShipmentOnlineController::class, 'store'])->name('shipmentOnline.store');
});

// Payment Gateway Routes
Route::controller(ShipmentOnlineController::class)->group(function () {
    Route::post('/handle-redirection', 'handleRedirection')->name('handle.redirection');
    Route::post('/web-hook', 'webHook')->name('web-hook');
    Route::get('/test-form', 'testForm')->name('test-form');
});

// Authentication Routes
Route::middleware(['guest'])->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'Login')->name('Login');
    Route::get('/register', 'showRegister')->name('showRegister');
    Route::post('/register', 'Register')->name('register');
});

// Account Management
Route::controller(AuthController::class)->group(function () {
    Route::post('store-account/{id}', 'storeAccount')->name('store-account');
    Route::get('/confirm-account/{token}', 'confirmAccount')->name('confirm-account');
});

// Settings
Route::get('/change-locale/{locale}', [Settings::class, 'setLocale'])->name('changeLocale');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'Logout'])->name('logout');
});

Route::middleware(['auth', 'complete.registration'])->group(function () {
    Route::get('dashboard', [HomePage::class, 'index'])->name('dashboard');

    // Admin Management Routes
    Route::group(['middleware' => ['permission:users']], function () {
        Route::resource('users', Users::class);
        Route::get('get-users', [Users::class, 'get_users'])->name('get-users');
    });



  // Role Management
  Route::group(['middleware' => ['permission:roles']], function () {
    Route::resource('roles', RolesController::class);
  });

  // Permission Management  
  Route::group(['middleware' => ['permission:permissions']], function () {
    Route::get('get-permissions', [PermissionsController::class, 'get_permissions'])->name('get-permissions');
    Route::resource('permissions', PermissionsController::class);
  });

  // Shipment Management
  Route::group(['middleware' => ['permission:shipments']], function () {
    Route::get('get-shipments', [ShipmentController::class, 'get_shipments'])->name('get-shipments');
    Route::resource('shipments', ShipmentController::class);
    
    Route::controller(ShipmentItemController::class)->group(function() {
      Route::get('get-shipmentItems/{id}', 'get_shipment_itmes')->name('get-shipment-itmes');
      Route::post('add-shipmentItem/{id}', 'add_shipment_item')->name('add-shipment-item');
      Route::resource('shipment-itmes', ShipmentItemController::class);
    });

    Route::resource('shipment-history', ShipmentHistoryController::class);
  });

  // Trip Management
  Route::group(['middleware' => ['permission:trips']], function () {
    Route::controller(TripController::class)->group(function() {
      Route::get('get-trips', 'get_trips')->name('get-trips');
      Route::get('get-trip-shipments/{id}', 'get_trip_shipments')->name('get-trip-shipments');
      Route::get('tracking/{id}', 'tracking')->name('tracking');
      Route::resource('trips', TripController::class);
    });
  });

  Route::resource('trip_shipments', TripShipmentController::class);

  Route::group(['middleware' => ['permission:trip_routes.index']], function () {
    Route::get('get-trip-routes', [TripRouteController::class, 'get_trip_routes'])->name('get-trip-routes');
    Route::resource('trip_routes', TripRouteController::class);
  });

  Route::resource('trip-history', TripHistoryController::class);

  // Inventory Management
  Route::controller(InventoryController::class)->group(function() {
    Route::get('get-inventories', 'getInventories')->name('get-inventories');
    Route::resource('inventory', InventoryController::class);
  });

  Route::controller(InventoryItemsController::class)->group(function() {
    Route::get('get-inventoryItems', 'getInventoryItems')->name('get-inventoryItems');
    Route::resource('inventoryItems', InventoryItemsController::class);
  });

  // Price Management
  Route::controller(PriceController::class)->group(function() {
    Route::get('get-prices', 'get_prices')->name('get-prices');
    Route::get('get-price', 'get_price')->name('get-price');
  });

  Route::group(['middleware' => ['permission:prices.index']], function () {
    Route::resource('prices', PriceController::class);
  });

  // Customer Management
  Route::group(['middleware' => ['permission:customers']], function () {
    Route::controller(CustomerController::class)->group(function() {
      Route::get('customers-all', 'getCustomers')->name('customers.all');
      Route::get('customers-shipments/{id}', 'getShipmetns')->name('customers.shipments');
      Route::post('customer-update', 'updateCustomerData')->name('customer.updateData');
      Route::post('customer-add-cash/{id}', 'addCashBalance')->name('customer.add-cash');
      Route::post('customer-add-coupon/{id}', 'addCoupon')->name('customer.add-coupon');
      Route::get('customer/profile', 'showProfile')->name('customer.profile');
      Route::post('customer/address', 'storeAddress')->name('customer.address.store');
      Route::post('customer/address/{id}/set-default', 'changeDefaultAddress')->name('customer.address.setDefault');
      Route::resource('customers', CustomerController::class);
    });
  });
  
  // Payment Management
  Route::group(['middleware' => ['permission:payments.index']], function () {
    Route::controller(PaymentController::class)->group(function() {
      Route::get('get-payments', 'getPayments')->name('get-payments');
      Route::get('payments/refund/{id}', 'refund')->name('refund');
      Route::get('/payments/{id}/print', 'print')->name('print');
      Route::resource('payments', PaymentController::class);
    });
  });

  // Coupon Management
  Route::get('coupon-verified/{id}', [CouponsController::class, 'checkCoupon'])->name('coupon.verified');

  // Location Management
  Route::group(['middleware' => ['permission:countries']], function () {
    Route::resource('countries', CountryController::class);
  });

  Route::group(['middleware' => ['permission:cities']], function () {
    Route::get('get-cities/{id}', [CityController::class, 'getCitiesByCountry'])->name('get-cities');
    Route::resource('cities', CityController::class);
  });

  Route::group(['middleware' => ['permission:addresses']], function () {
    Route::resource('addresses', AddressController::class);
  });

  // Type Management
  Route::group(['middleware' => ['permission:good_types.index']], function () {
    Route::resource('good_types', GoodTypeController::class);
  });
  
  Route::group(['middleware' => ['permission:parcel_types.index']], function () {
    Route::resource('parcel_types', ParcelTypeController::class);
  });

  // Currency Management
  Route::group(['middleware' => ['permission:currencies.index']], function () {
    Route::controller(CurrencyController::class)->group(function() {
      Route::get('get-currencies', 'getCurrencies')->name('get-currencies');
      Route::resource('currencies', CurrencyController::class);
    });
  });
});