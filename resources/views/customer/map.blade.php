@extends('customer.layouts.app-map')

@section('content')
<!-- Header-->

<!-- Section-->

@php
    if(auth()->check()){
        $defaultLat = auth()->user()->latitude;
		$defaultLong = auth()->user()->longitude;
    }else{
        $defaultLat = 23.7283894;
		$defaultLong = 90.4206081;
    }
@endphp

@endsection