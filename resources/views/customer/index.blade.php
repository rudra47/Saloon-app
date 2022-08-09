@extends('customer.layouts.app1')

@section('content')
<!-- Header-->
@include('admin.layouts.partials.preloader')
<!-- Section-->
<section class="py-5" style="min-height: 780px;">
    <div class="container px-4 px-lg-5 mt-5">
        <h3>Available Saloons Near You</h3>
        <hr/>
        <div class="row" id="progress">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="saloon-data">
        </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="saloon-data-default">
            @if(count($saloons) > 0)
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
            @else
                <h5 class="text-center">No saloon found nearby.</h5>
            @endif
            
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#saloon-data-default').hide();

        //let html = '<h5 class="text-center">No saloon found!</h5>';
        locate();

        function locate(){
            if ("geolocation" in navigator){
                navigator.geolocation.getCurrentPosition(function(position){ 
                    var currentLatitude = position.coords.latitude;
                    var currentLongitude = position.coords.longitude;
                    //alert("Current Latitude: " + currentLatitude);

                    var infoWindowHTML = "Latitude: " + currentLatitude + "<br>Longitude: " + currentLongitude;
                    var html = '<h5 class="text-center">Latitude: ' + currentLatitude + '; Longitude: ' + currentLongitude + '</h5>';
                    //$('#saloon-data').html(html);

                    $.ajax({
                        type: 'GET',
                        url: '/get-saloons/'+currentLatitude+'/'+currentLongitude,
                        dataType: "JSON",
                        success: function (response) {
                            if(response.length > 0){
                                var html = '';
                                $.each(response, function (key, val) { 
                                    var imagePath = '';
                                    if(val.image){
                                        imagePath = '/images/saloons/' + val.image;
                                    }else{
                                        imagePath = 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg';
                                    }

                                    var phone = '';
                                    if(val.phone){
                                        phone = val.phone;
                                    }else{
                                        phone = '';
                                    }

                                    var email = '';
                                    if(val.email){
                                        email = val.email;
                                    }else{
                                        email = '';
                                    }

                                    var address = '';
                                    if(val.address){
                                        address = val.address;
                                    }else{
                                        address = '';
                                    }

                                    html += '<div class="col mb-5">';
                                    html +=     '<div class="card h-100">';
                                    html +=         '<!-- Product image-->';
                                    html +=         '<img class="card-img-top" src="'+imagePath+'" alt="cover photo" />';
                                    html +=         '<!-- Product details-->';
                                    html +=         '<div class="card-body p-4">';
                                    html +=             '<div class="text-center">';
                                    html +=                 '<!-- Saloon name-->';
                                    html +=                 '<h5 class="fw-bolder">';
                                    html +=                            val.name;
                                    html +=                 '</h5>';
                                    html +=                 '<b>Phone:</b>' + phone + '<br/>';
                                    html +=                 '<b>Email:</b>' + email + '<br/>';
                                    html +=                 '<b>Address:</b>' + address + '<br/>';
                                    html +=              '</div>';
                                    html +=         '</div>';
                                    html +=         '<!-- Saloon actions-->';
                                    html +=         '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
                                    html +=              '<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="/saloon/' + val.id + '">View services</a></div>';
                                    html +=         '</div>';
                                    html +=      '</div>';
                                    html += '</div>';
                                });
                                $('#saloon-data').html(html);
                            }else{
                                var html = '<h5 class="text-center">No saloon found nearby!</h5>';
                                $('#saloon-data').html(html);
                            }
                            console.log(response.length);
                            $('#progress').hide();
                        },
                        error: function(xhr) {
                            console.log(xhr);
                        }
                    });
                },
                () => {
                    $('#progress').hide();
                    $('#saloon-data').hide();
                    $('#saloon-data-default').show();
                }
                );
            }else{
                $('#progress').hide();
                $('#saloon-data').hide();
                $('#saloon-data-default').show();
            }
        }

        
    });
</script>
@endpush