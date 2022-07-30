@extends('customer.layouts.app1')

@section('content')
<!-- Header-->
<div class="container">
    <header class="bg-dark py-5 mt-5 rounded" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('@if($saloon->cover_image){{ asset('images/saloons/'.$saloon->cover_image) }} @else {{ asset('images/saloons/demo-saloon-cover.jpg') }} @endif'); background-repeat: no-repeat; background-size: cover;">
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
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h3>Available Services</h3>
        <hr/>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card">
                    <!-- Saloon image-->
                    {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
                    <!-- Saloon details-->
                    
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Saloon name-->
                            <h5 class="fw-bolder">Hair Cut for Baby</h5>
                            <!-- Saloon reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Saloon price-->
                            <span class="text-muted text-decoration-line-through">BDT 50.00</span> BDT 40.00<br>
                        </div>
                    </div>
                    <!-- Saloon actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <form action="{{ route('saloon.book') }}" method="post">
                                @csrf
                                <input type="hidden" name="service" value="0">
                                <button class="btn btn-outline-dark mt-auto" type="submit">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card">
                    <!-- Saloon image-->
                    {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
                    <!-- Saloon details-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">20% off</div>
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Saloon name-->
                            <h5 class="fw-bolder">Hair Cut Normal</h5>
                            <!-- Saloon reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Saloon price-->
                            BDT 40.00
                        </div>
                    </div>
                    <!-- Saloon actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <form action="{{ route('saloon.book') }}" method="post">
                                @csrf
                                <input type="hidden" name="service" value="0">
                                <button class="btn btn-outline-dark mt-auto" type="submit">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card">
                    <!-- Saloon image-->
                    {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
                    <!-- Saloon details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Saloon name-->
                            <h5 class="fw-bolder">Hair Cut Special</h5>
                            <!-- Saloon reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Saloon price-->
                            BDT 100.00
                        </div>
                    </div>
                    <!-- Saloon actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <form action="{{ route('saloon.book') }}" method="post">
                                @csrf
                                <input type="hidden" name="service" value="0">
                                <button class="btn btn-outline-dark mt-auto" type="submit">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card">
                    <!-- Saloon image-->
                    {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
                    <!-- Saloon details-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">10% off</div>
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Saloon name-->
                            <h5 class="fw-bolder">Head Massage</h5>
                            <!-- Saloon reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Saloon price-->
                            <span class="text-muted text-decoration-line-through">BDT 50.00</span> BDT 45.00<br>
                        </div>
                    </div>
                    <!-- Saloon actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <form action="{{ route('saloon.book') }}" method="post">
                                @csrf
                                <input type="hidden" name="service" value="0">
                                <button class="btn btn-outline-dark mt-auto" type="submit">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col mb-5">
                <div class="card">
                    <!-- Saloon image-->
                    {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
                    <!-- Saloon details-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">20% off</div>
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Saloon name-->
                            <h5 class="fw-bolder">Hair Cut for Baby</h5>
                            <!-- Saloon reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Saloon price-->
                            <span class="text-muted text-decoration-line-through">BDT 50.00</span> BDT 40.00<br>
                        </div>
                    </div>
                    <!-- Saloon actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <form action="{{ route('saloon.book') }}" method="post">
                                @csrf
                                <input type="hidden" name="service" value="0">
                                <button class="btn btn-outline-dark mt-auto" type="submit">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card">
                    <!-- Saloon image-->
                    {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
                    <!-- Saloon details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Saloon name-->
                            <h5 class="fw-bolder">Hair Cut Normal</h5>
                            <!-- Saloon reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Saloon price-->
                            BDT 80.00
                        </div>
                    </div>
                    <!-- Saloon actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <form action="{{ route('saloon.book') }}" method="post">
                                @csrf
                                <input type="hidden" name="service" value="0">
                                <button class="btn btn-outline-dark mt-auto" type="submit">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card">
                    <!-- Saloon image-->
                    {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
                    <!-- Saloon details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Saloon name-->
                            <h5 class="fw-bolder">Hair Cut Special</h5>
                            <!-- Saloon reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Saloon price-->
                            BDT 100.00
                        </div>
                    </div>
                    <!-- Saloon actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <form action="{{ route('saloon.book') }}" method="post">
                                @csrf
                                <input type="hidden" name="service" value="0">
                                <button class="btn btn-outline-dark mt-auto" type="submit">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card">
                    <!-- Saloon image-->
                    {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
                    <!-- Saloon details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Saloon name-->
                            <h5 class="fw-bolder">Head Massage</h5>
                            <!-- Saloon reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Saloon price-->
                            BDT 45.00<br>
                        </div>
                    </div>
                    <!-- Saloon actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <form action="{{ route('saloon.book') }}" method="post">
                                @csrf
                                <input type="hidden" name="service" value="0">
                                <button class="btn btn-outline-dark mt-auto" type="submit">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection