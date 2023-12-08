<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:customers,email'],
            'phone' => ['required', 'string', 'max:20', 'unique:customers,phone'],
            'address' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'exists:countries,id'],
            'city_id' => ['required', 'exists:cities,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }

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
        $customer->customer_code = $newCode;
        $customer->type = 'Local';
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->country_id = $request->country_id;
        $customer->city_id = $request->city_id;
        $customer->status = 1;
        $customer->save();

        return response()->json(['message' => __('Customer added successfully')]);


    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}