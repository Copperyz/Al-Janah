<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ParcelType;
use App\Models\Currency;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $customerRole = Role::create(['name' => 'Customer']);

        // Seed permissions
        $permissions = [
            ['name' => 'dashboard', 'guard_name' => 'web'],
            ['name' => 'landing-page', 'guard_name' => 'web'],
            ['name' => 'users', 'guard_name' => 'web'],
            ['name' => 'roles', 'guard_name' => 'web'],
            ['name' => 'permissions', 'guard_name' => 'web'],
            ['name' => 'inventory', 'guard_name' => 'web'],
            ['name' => 'shipments', 'guard_name' => 'web'],
            ['name' => 'show shipment', 'guard_name' => 'web'],
            ['name' => 'add shipment', 'guard_name' => 'web'],
            ['name' => 'trips', 'guard_name' => 'web'],
            ['name' => 'trips.index', 'guard_name' => 'web'],
            ['name' => 'trip_routes.index', 'guard_name' => 'web'],
            ['name' => 'prices.index', 'guard_name' => 'web'],
            ['name' => 'customers', 'guard_name' => 'web'],
            ['name' => 'customers.index', 'guard_name' => 'web'],
            ['name' => 'payments.index', 'guard_name' => 'web'],
            ['name' => 'countries', 'guard_name' => 'web'],
            ['name' => 'countries.index', 'guard_name' => 'web'],
            ['name' => 'cities', 'guard_name' => 'web'],
            ['name' => 'cities.index', 'guard_name' => 'web'],
            ['name' => 'addresses', 'guard_name' => 'web'],
            ['name' => 'addresses.index', 'guard_name' => 'web'],
            ['name' => 'good_types.index', 'guard_name' => 'web'],
            ['name' => 'parcel_types.index', 'guard_name' => 'web'],
            ['name' => 'show-trips-card', 'guard_name' => 'web'],
            ['name' => 'show-shipments-card', 'guard_name' => 'web'],
            ['name' => 'show-tripRotes-card', 'guard_name' => 'web'],
            ['name' => 'show-payments-card', 'guard_name' => 'web'],
            ['name' => 'show-users-card', 'guard_name' => 'web'],
            ['name' => 'show-customers-card', 'guard_name' => 'web'],
            ['name' => 'currencies.index', 'guard_name' => 'web'],
            ['name' => 'print invoice', 'guard_name' => 'web'],
        ];

        $permissionModels = collect($permissions)->map(function ($permission) {
            return Permission::create($permission);
        });

        // Assign all permissions to the Super Admin role
        $superAdminRole->permissions()->attach($permissionModels->pluck('id'));

        // Filter permissions for the Customer role
        $customerPermissions = $permissionModels->filter(function ($permission) {
            return in_array($permission['name'], ['dashboard', 'shipments', 'show-shipments-card', 'show-payments-card']);
        });

        // Assign filtered permissions to the Customer role
        $customerRole->permissions()->attach($customerPermissions->pluck('id'));

        // Seed a Super Admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@janahx.com',
            'password' => bcrypt('NahaisiHenry'),
        ]);

        $admin->assignRole($superAdminRole);

        // Seed Parcel Types
        $parcelType = ParcelType::create(['name' => 'Box']);

        // Seed Currencies
        $currencies = [
            ['name' => 'US Dollar', 'symbol' => '$', 'valueInUsd' => 1.000],
            ['name' => 'Libyan Dinar', 'symbol' => 'LYD', 'valueInUsd' => 0.21],
            ['name' => 'Turkish Lira', 'symbol' => '₺', 'valueInUsd' => 0.029],
            ['name' => 'Euro', 'symbol' => '€', 'valueInUsd' => 1.090],
            ['name' => 'British Pound', 'symbol' => '£', 'valueInUsd' => 1.200],
            ['name' => 'Chinese Yuan', 'symbol' => 'CN¥', 'valueInUsd' => 0.14],
        ];

        // Insert each currency into the database
        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
