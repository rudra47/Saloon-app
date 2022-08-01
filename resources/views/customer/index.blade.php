@extends('customer.layouts.app1')

@section('content')
<!-- Header-->
@include('admin.layouts.partials.preloader')
<!-- Section-->
<section class="py-5" style="min-height: 780px;">
    <div class="container px-4 px-lg-5 mt-5">
        <h3>Available Saloons Near You</h3>
        <hr/>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($saloons as $saloon)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="@if($saloon->image){{ asset('images/saloons/'.$saloon->image) }} @else https://dummyimage.com/450x300/dee2e6/6c757d.jpg @endif" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Saloon name-->
                                <h5 class="fw-bolder">
                                    {{ $saloon->name }}
                                </h5>
                                @if($saloon->phone)<b>Phone:</b> {{ $saloon->phone }}<br/>@endif
                                @if($saloon->email)<b>Email:</b> {{ $saloon->email }}<br/>@endif
                                @if($saloon->address)<b>Address:</b> {{ $saloon->address }}<br/>@endif
                            </div>
                        </div>
                        <!-- Saloon actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('saloon.view', $saloon->id) }}">View services</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection