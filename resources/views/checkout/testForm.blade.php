@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp


@extends('layouts.blankLayout')

@section('content')
    <form action="{{ route('handle.redirection') }}" method="post" id="simulationForm">
        @csrf
        <input type="hidden" name="json_data" value="{{ $json_data }}">

        <div class="container mt-5">
            <div class="text-center mt-5">
                <button class="btn btn-success" type="submit">Simulate Redirectiox</button>
            </div>
        </div>
    </form>
@endsection
