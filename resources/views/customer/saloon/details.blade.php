@extends('customer.layouts.app1')

@section('content')
<!-- Header-->
@include('admin.layouts.partials.preloader')

<div class="container">
    <header class="bg-dark py-5 mt-5 mb-3 rounded" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('@if($saloon->cover_image){{ asset('images/saloons/'.$saloon->cover_image) }} @else {{ asset('images/saloons/demo-saloon-cover.jpg') }} @endif'); background-repeat: no-repeat; background-size: cover;">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">{{ $saloon->name }}</h1>
                @if($saloon->phone)<p class="lead fw-normal text-white-50 mb-0">{{ $saloon->phone }}</p>@endif
                @if($saloon->email)<p class="lead fw-normal text-white-50 mb-0">{{ $saloon->email }}</p>@endif
                @if($saloon->address)<p class="lead fw-normal text-white-50 mb-0">{{ $saloon->address }}</p>@endif
            </div>
        </div>
    </header>
</div>
<!-- Section-->
<div class="container">
    <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
            @include('flash::message')
        </div>
    </div>
</div>
<section class="py-5" style="min-height: 360px">
    <div class="container px-4 px-lg-5 mt-2">
        <h3>Available Services</h3>
        <hr/>
        @if(count($services)>0)
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($services as $service)
                    <div class="col mb-5">
                        <div class="card">
                            <!-- Saloon image-->
                            {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
                            <!-- Saloon details-->
                            @if($service->discount_price > 0)
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">@if($service->discount_type == 1) BDT {{ $service->discount_price }} @else {{ $service->discount_price }}% @endif off</div>
                            @endif
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Saloon name-->
                                    <h5 class="fw-bolder">{{ $service->name }}</h5>
                                    <!-- Saloon reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Saloon price-->
                                    @if($service->discount_price > 0)
                                        <span class="text-muted text-decoration-line-through">BDT {{ $service->price }}</span> BDT @if($service->discount_type == 1) {{ $service->price - $service->discount_price }} @else {{ $service->price - ($service->discount_price*$service->price/100) }} @endif<br>
                                    @else
                                        {{ $service->price }}
                                    @endif
                                </div>
                            </div>
                            <!-- Saloon actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <form action="{{ route('saloon.book') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="service" value="{{ $service->id }}">
                                        <button class="btn btn-outline-dark mt-auto" type="submit">Book Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h4 class="text-center">No services found!</h4>
        @endif
    </div>
</section>
@endsection