<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer; // Import your Customer model

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // Generate 1000 customer records
        Customer::factory()->count(10000)->create();
    }
}
