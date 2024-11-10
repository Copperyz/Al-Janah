<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('currencies.index', compact('currencies'));
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
            'name' => ['required', 'string', 'max:30'],
            'symbol' => ['required', 'string', 'max:10'],
            'valueInUsd' => ['required', 'numeric', 'min:0']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->valueInUsd = $request->valueInUsd;
        $currency->save();

        return response()->json(['message' => __('Currency added successfully')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:30'],
            'symbol' => ['required', 'string', 'max:10'],
            'valueInUsd' => ['required', 'numeric', 'min:0']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => $validator->errors()
            ], 422);
        }
        $currency = Currency::find($id);
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->valueInUsd = $request->valueInUsd;
        $currency->save();

        return response()->json(['message' => __('Currency updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $currency = Currency::find($id);

        if ($currency) {
            $currency->delete();
            return response()->json(['message' => __('Currency deleted successfully')]);
        }

        return response()->json(['message' => __('Currency not found')], 404);
    }

    public function getCurrencies()
    {
        $currencies = Currency::get();
        return Datatables::of($currencies)
        ->addColumn('options', function ($currency) {
            $options = '<div class="text-xxl-center">';
            $options .= '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>';
            $options .= '<div class="dropdown-menu dropdown-menu-end m-0">';

            // Edit button based on 'edit currency' permission
            if (auth()->user()->can('edit currency')) {
                $options .= '<a href="javascript:;" class="dropdown-item editCurrency" data-bs-target="#editCurrencyModal" data-bs-toggle="modal" data-bs-dismiss="modal">' .
                            '<i class="ti ti-edit me-2"></i>' . __('Edit') . '</a>';
            }

            // Delete button based on 'delete currency' permission
            if (auth()->user()->can('delete currency')) {
                $options .= '<a href="javascript:;" class="dropdown-item delete-record">' .
                            '<i class="ti ti-trash me-2"></i>' . __('Delete') . '</a>';
            }

            $options .= '</div></div>';

            return $options;
        })
        ->rawColumns(['options'])
        ->make(true);
    }
}
