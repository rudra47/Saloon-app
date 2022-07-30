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
    <h3>Available Saloons Near You</h3>
    <hr/>
    <div class="row">
        @foreach ($saloons as $saloon)
        <div class="col-sm-4">
            <div class="thumbnail">
                
                <img src="@if($saloon->image){{ asset('images/saloons/'.$saloon->image) }} @else {{ asset('images/saloons/demo-saloon.jpg') }} @endif" alt="Lights" style="width:100%">
                <div class="caption">
                    <h4>{{ $saloon->name }}</h4>
                    @if($saloon->phone)<p>Phone: {{ $saloon->phone }}</p>@endif
                    @if($saloon->email)<p>Email: {{ $saloon->email }}</p>@endif
                    @if($saloon->address)<p>Address: {{ $saloon->address }}</p>@endif

                    <div class="row">
                        <a class="btn btn-primary btn-xs" href="{{ route('saloon.view', $saloon->id) }}" style="float: right; margin-right: 15px;">View Details</a>
                    </div>
                </div>
                
              </div>
        </div>
        @endforeach
    </div>
</div>
@endsection