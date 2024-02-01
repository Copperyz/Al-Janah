<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Shipment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('shipment')->get();
        return view('payments.index', compact('payments'));
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
        // return $request;
        $validator = Validator::make($request->all(), [
        'date' => ['required', 'date'],
        'shipment_id' => ['required', 'string', 'exists:shipments,id'],
        'shipment_amount' => ['required', 'string'],
        'order_amount' => ['required', 'string'],
        'paymentMethod' => ['required', 'string']
        ]);
        
        if ($validator->fails()) {
        return response()->json(
            [
            'message' => __('The given data was invalid'),
            'errors' => $validator->errors(),
            ],
            422
        );
        }
        try {
            $transaction_id = Str::random(12);
            while (Payment::where('transaction_id', $transaction_id)->exists()) {
            // Regenerate if the generated tracking number already exists
            $transaction_id = Str::random(12);
            }
            $paymentMethod = 'CASH';
            if($request->paymentMethod == "cashBalance"){
                $shipment = Shipment::with('customer')->findOrFail($request->shipment_id);
                if($shipment->customer->totalAmountDecrease($request->shipment_amount + $request->order_amount)){
                    $paymentMethod = 'Cash Balance';
                }else{
                    return response()->json(['error' => __('Insufficient balance')], 422); // 422 Unprocessable Entity
                }
            } 
            // Create the Payment
            $payment = Payment::create([
            'shipment_id' => $request->shipment_id,
            // 'date' => $request->input('date'),
            'payment_method' =>  $paymentMethod,
            'transaction_id' => $transaction_id,
            'shipment_amount' =>  $request->shipment_amount,
            'order_amount' =>  $request->order_amount,
            'created_by' => auth()->user()->id,
            ]);

            return response()->json(['message' => __('Payment created successfully')], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => __('The given data was invalid')
              ], 422);
        }
        // Generate random unique transaction_id

        // Return a response as needed
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function refund($id)
    {
        $payment = Payment::where('id', $id)->first();
        if ($payment->status == 'paid') {
            $payment->status = 'refunded';
            $payment->save();
            return response()->json(['message' => __('Payment refunded successfully')]);
        }
        else {
            $payment->status = 'paid';
            $payment->save();
            return response()->json(['message' => __('Payment paid successfully')]);
        }
    }

    public function getPayments()
    {
        $payments = Payment::with('shipment')->get();
        return Datatables::of($payments)
        ->addColumn('delivery_code', function ($payment) {
        // Access shipment data here, for example:
        return $payment->shipment->delivery_code;
        })
        ->addColumn('date', function ($payment) {
        // Access shipment data here, for example:
        return Carbon::parse($payment->created_at)->format('Y-m-d g:i A');
        })
        ->addColumn('statusCapped', function ($payment) {
        // Access shipment data here, for example:
        return $payment->status == 'paid' ? __('Paid') : __('Refunded');
        })
        ->make(true);
    }
}