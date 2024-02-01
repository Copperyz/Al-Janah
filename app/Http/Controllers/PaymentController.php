<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\GoodType;
use App\Models\Shipment;
use App\Models\ParcelType;
use Illuminate\Support\Str;
use App\Models\ShipmentItem;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
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
        $validator = Validator::make($request->all(), [
        'date' => ['required', 'date'],
        'shipment_id' => ['required', 'string', 'exists:shipments,id'],
        'shipment_amount' => ['required', 'string'],
        'order_amount' => ['required', 'string']
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

        // Generate random unique transaction_id
        $transaction_id = Str::random(12);
        while (Payment::where('transaction_id', $transaction_id)->exists()) {
        // Regenerate if the generated tracking number already exists
        $transaction_id = Str::random(12);
        }

        // Create the Payment
        $payment = Payment::create([
        'shipment_id' => $request->shipment_id,
        // 'date' => $request->input('date'),
        'payment_method' =>  'CASH',
        'transaction_id' => $transaction_id,
        'shipment_amount' =>  $request->shipment_amount,
        'order_amount' =>  $request->order_amount,
        'created_by' => auth()->user()->id,
        ]);
        
        if (isset($request->fulfilled)){
            $shipmentId = $payment->shipment_id;
            InventoryItem::where('shipment_id', $shipmentId)
            ->update(['status' => 'fulfilled']);
        }

        // Return a response as needed
        return response()->json(['message' => __('Payment created successfully')], 200);
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

    public function print($id)
    {
        $pageConfigs = ['myLayout' => 'blank'];
        $shipment = Shipment::where('id', $id)->first();
        $parcelTypes = ParcelType::all();
        $goodTypes = GoodType::all();
        $payment = Payment::where('shipment_id', $id)->first();
        $shipmentItems = ShipmentItem::where('shipment_id', $shipment->id)->get();
        return view('payments.print', compact('shipment', 'parcelTypes', 'goodTypes', 'payment', 'shipmentItems'), ['pageConfigs' => $pageConfigs]);
    }
}