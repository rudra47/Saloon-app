@extends('customer.layouts.app')

@push('css')
<style>
    .navbar .container-fluid {
        padding-top: 1rem;
    }
</style>

@endpush

@section('content')
<div class="container">
    <img src="@if($saloon->cover_image){{ asset('images/saloons/'.$saloon->cover_image) }} @else {{ asset('images/saloons/demo-saloon-cover.jpg') }} @endif" class="img-rounded" alt="Cinque Terre" style="width: 100%; max-height: 300px;">
</div>
@endsection