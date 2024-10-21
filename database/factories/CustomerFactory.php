<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        $lastCustomer = Customer::latest()->first();
        if ($lastCustomer) {
            $lastCode = $lastCustomer->customer_code;
            preg_match('/([A-Z]+)(\d+)/', $lastCode, $matches);
            $letterPart = $matches[1];
            $numberPart = intval($matches[2]);

            if ($numberPart < 1000) {
                $numberPart++;
            } else {
                $letterPart = chr(ord($letterPart) + 1);
                $numberPart = 1;
            }

            $newCode = $letterPart . $numberPart;
        } else {
            $newCode = 'A1';
        }

        

        $user = User::factory()->create([
            'name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail, // Ensure unique email
            'password' => bcrypt('password'),
        ]);

        return [
            'customer_code' => $newCode,
            'type' => 'Local',
            'first_name' => $user->name,
            'last_name' => $this->faker->lastName,
            'email' => $user->email,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'country_id' => rand(1, 3),
            'city_id' => rand(1, 3),
            'status' => 1,
            'user_id' => $user->id,
            'created_by' => 1, // Assuming created by admin with ID 1
        ];
    }
}
