<!-- checkout.blade.php -->

@extends('layouts.blankLayout')

@section('content')
    <form action="{{ route('handle.redirection') }}" method="post" id="simulationForm">
        @csrf
        <input type="hidden" name="json_data" value="{{ $json_data }}">

        <div class="container mt-5">
            <div class="text-center mt-5">
                <button class="btn btn-success" type="submit">Simulate Redirection</button>
            </div>
        </div>
    </form>
@endsection
