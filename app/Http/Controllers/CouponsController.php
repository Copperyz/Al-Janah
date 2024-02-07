<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CouponsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupons $coupons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupons $coupons)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupons $coupons)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupons $coupons)
    {
        //
    }
    public function checkCoupon(Request $request, $couponCode)
    {
        $currentDate = Carbon::now();
        
        $coupon = Coupons::where('code', $couponCode)
        ->where('used', 0)
        ->where('expiry_date', '>', $currentDate)
        ->first('amount');
        
        if ($coupon) {
            // Coupon exists
            $shipmentDiscount = $request->shipmentAmount - (($coupon->amount / 100) * $request->shipmentAmount);
            session(['newDeliveryCost' => $shipmentDiscount]);
            return response()->json(['shipmentDiscount' => $shipmentDiscount], 200);
        } else {
            // Coupon does not exist
            return response()->json(['error' => __('Coupon not found')], 404);
        }
    }
}
