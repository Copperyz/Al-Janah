@extends('layouts/layoutMaster')

@section('title', __('INVOICE') . ' #' . $shipment->id)

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice-print.css') }}" />
@endsection

@section('page-script')
@endsection

@section('content')
    <div class="invoice-print p-5">

        <div class="d-flex justify-content-between flex-row">
            <div class="mb-4">
                @include('_partials.macros', ['height' => 20, 'withbg' => ''])
                <span class="app-brand-text fw-bold">
                    {{ config('variables.templateName') }}
                </span>
            </div>
            <div>
                <h4 class="fw-medium">{{ __('INVOICE') }} #{{ $shipment->id }}</h4>
                <div class="mb-2">
                    <span class="text-muted">{{ __('Date Issue') }}:</span>
                    <span class="fw-medium">{{ $shipment->date }}</span>
                </div>
                <div>
                    <span class="text-muted">{{ __('Fulfill Date') }}:</span>
                    <span class="fw-medium">{{ now()->format('Y-m-d') }}</span>
                </div>
            </div>
        </div>

        <hr />
        <div dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}" class="d-flex">
            <div class="col-sm-6 w-50">
                <h6 class="me-5">{{ __('Customer Details') }}</h6>
                <table>
                    <tbody>
                        <tr>
                            <td class="pe-4">{{ __('Name') }}:</td>
                            <td class="fw-medium">{{ $shipment->customer->first_name }}
                                {{ $shipment->customer->last_name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-4">{{ __('Phone') }}:</td>
                            <td>{{ $shipment->customer->phone }}</td>
                        </tr>
                        <tr>
                            <td class="pe-4">{{ __('Email') }}:</td>
                            <td>{{ $shipment->customer->email }}</td>
                        </tr>
                        <tr>
                            <td class="pe-4">{{ __('Country') }}:</td>
                            <td>{{ $shipment->customer->country->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td class="pe-4">{{ __('City') }}:</td>
                            <td>{{ $shipment->customer->city->name ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6 w-50">
                <h6 class="me-5">{{ __('Order Details') }}</h6>
                <table>
                    <tbody>
                        <tr>
                            <td class="pe-4">{{ __('Tracking Number') }}:</td>
                            <td class="fw-medium">{{ $shipment->tracking_no }}</td>
                        </tr>
                        <tr>
                            <td class="pe-4">{{ __('Delivery Code') }}:</td>
                            <td>{{ $shipment->delivery_code }}</td>
                        </tr>
                        <tr>
                            <td class="pe-4">{{ __('Items') }}:</td>
                            <td>{{ count($shipmentItems) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr />


        <div class="table-responsive" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
            <table class="table m-0">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('Good Type') }}</th>
                        <th>{{ __('Parcel Type') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <th>{{ __('Weight') }}</th>
                        <th>{{ __('Price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipmentItems as $shipmentItem)
                        <tr>
                            <td>{{ $shipmentItem->goodType->name }}</td>
                            <td>{{ $shipmentItem->parcelType->name }}</td>
                            <td>{{ $shipmentItem->quantity }}</td>
                            <td>{{ $shipmentItem->weight }} {{ __('Kg') }}</td>
                            <td>{{ number_format($shipmentItem->price, 2) }} {{ $shipment->currency->symbol }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="align-top px-4 py-3">
                            <p class="mb-2">
                                <span class="me-1 fw-medium"></span>
                                <span></span>
                            </p>
                            <span></span>
                        </td>
                        <td class="">
                            <p class="mb-2">{{ __('Packages cost') }}:</p>
                            <p class="mb-2">{{ __('Freight cost') }}:</p>
                            <p class="mb-0">{{ __('Total Amount') }}:</p>
                        </td>
                        <td class="">
                            <!-- Reduced vertical padding -->
                            <p class="fw-medium mb-2">{{ $shipment->amount }} {{ $shipment->currency->symbol }}</p>
                            <p class="fw-medium mb-2">{{ $shipment->shipmentPrice }} {{ $shipment->currency->symbol }}</p>
                            <p class="fw-medium mb-2">{{ number_format($shipment->amount + $shipment->shipmentPrice, 2) }}
                                {{ $shipment->currency->symbol }}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row mt-4" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
            <div class="col-12">
                <span>{{ __('It was a pleasure serving you and working with you. We hope you will consider us for future orders. Thank you!') }}</span>
            </div>
        </div>
    </div>
@endsection

<script>
    window.onload = function() {
        // Use the print method to open the print dialog when the page loads
        window.print();
    };
</script>
