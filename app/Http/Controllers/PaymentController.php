<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\GoodType;
use App\Models\ParcelType;
use App\Models\Shipment;
use Illuminate\Support\Str;
use App\Models\ShipmentItem;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:print invoice')->only('print');
    }


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
        'currency' => ['required', 'string', 'exists:currencies,id'],
        'currency' => ['required', 'exists:currencies,id'],
        'shipment_amount' => ['required', 'numeric', 'min:0'],
        'order_amount' => ['required', 'numeric', 'min:0'],
        'additional_amount' => ['nullable', 'numeric', 'min:0'],
        'paymentMethod' => ['required', 'string', 'in:cash,cashBalance'],
        'fulfilled' => ['nullable']
        ]);
        
        if ($validator->fails()) {
        return response()->json(
            [
            'message' => __('The given data was invalid'),
            'errors' => $validator->errors(),
            ],422
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
                    return response()->json([
                        'message' => __('Insufficient balance')
                    ], 422);
                    }
            } 
            // Create the Payment
            $payment = Payment::create([
            'shipment_id' => $request->shipment_id,
            'currency_id' => $request->currency,
            'payment_method' =>  $paymentMethod,
            'transaction_id' => $transaction_id,
            'shipment_amount' =>  $request->shipment_amount,
            'order_amount' =>  $request->order_amount,
            'additional_amount' =>  $request->additional_amount,
            'total_amount' =>  $request->shipment_amount + $request->order_amount + $request->additional_amount,
            'created_by' => auth()->user()->id,
            ]);

            if (isset($request->fulfilled)){
                $shipmentId = $payment->shipment_id;
                InventoryItem::where('shipment_id', $shipmentId)
                ->update(['status' => 'fulfilled']);
            }

            return response()->json(['message' => __('Payment created successfully')], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => __('The given data was invalid')
              ], 422);
        }
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
        if ($payment->status == 'Paid') {
            $payment->status = 'Refunded';
            $payment->save();
            return response()->json(['message' => __('Payment refunded successfully')]);
        }
        else {
            $payment->status = 'Paid';
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
        return $payment->status == 'Paid' ? __('Paid') : __('Refunded');
        })
        ->addColumn('currency', function ($payment) {
            return $payment->currency ? __($payment->currency->symbol) : __('USD');
        })
        ->addColumn('options', function ($payment) {
            $options = '<div class="text-xxl-center">';
            $options .= '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>';
            $options .= '<div class="dropdown-menu dropdown-menu-end m-0">';

            if (auth()->user()->can('refund payment')) {
                if ($payment->status == 'Refunded') {
                    $options .= '<a href="javascript:;" class="dropdown-item refund-record" title="' . __('Payment') . '"><i class="ti ti-receipt me-2"></i>' . __('Payment') . '</a>';
                } else {
                    $options .= '<a href="javascript:;" class="dropdown-item refund-record" title="' . __('Refund') . '"><i class="ti ti-reload me-2"></i>' . __('Refund') . '</a>';
                }
            }
            $options .= '</div></div>';
            return $options;
        })
        ->rawColumns(['options'])
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