<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ env('APP_NAME') }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('/') }}images/favicon.ico" />

        <script type="text/javascript" src="{{ asset('/') }}js/jquery-1.7.1.min.js"></script>
		<script src="{{ asset('/') }}js/jquery-autocomplete-ui.js"></script>

        
		
		<script src="{{ asset('/') }}js/select_min.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('/') }}js/select_min.css"/>
        

		<!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('/') }}css/styles.css" rel="stylesheet" />

        <style type="text/css">
       
            #map-canvas { width: 100%; height:calc(100% - 55px); border: 0px; padding: 0px; position: absolute; top: 55px; }
            /*#map-canvas { width: 100%; height:500px; border: 0px; padding: 0px;}*/
            .gm-style .gm-style-iw-c {
                width: 330px !important;
                max-width: 330px !important;
            }
            .gm-style .gm-style-iw-d {
                width: 100% !important;
                max-width: 100% !important;
            }
            .mapInfo span {
                display: inline-block;
                width: 90px;
            }
            
            .pull-right {
                float: right!important;
                width: 100%;
            }
           
            .form-inline {
                display: flex;
                flex-flow: row wrap;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="{{ route('map') }}">Map</a></li> -->
                        <li class="nav-item">
                            <div class="form-inline" style="margin-left: 20px;">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search_location" id="locationSearchInput" placeholder="Search Location">
                                </div>
                                {{-- <button type="submit" class="btn btn-primary d-none" style="margin-left: 5px;">Search</button> --}}
                                <div class="row" id="progress" style="margin-left: 5px;">
                                    <div class="d-flex justify-content-center">
                                        <div class="spinner-border text-primary" role="status">
                                          <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                    <ul class="d-flex navbar-nav">
                        @if(auth()->check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle active" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }} </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item text-center" href="#" onclick="event.preventDefault();" style="cursor: auto; font-weight: bold;">{{ auth()->user()->name }}</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li><a class="dropdown-item" href="{{ route('bookings') }}"><i class="bi-filter-right me-1"></i> My Bookings</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi-person-fill me-1"></i> My Profile</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi-box-arrow-left me-1"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{route('register')}}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        @endif

                        <li class="nav-item" style="margin-left: 10px;">
                            <a href="{{ route('saloon.apply') }}" class="btn btn-outline-light" type="submit">
                                <i class="bi-plus-circle-fill me-1"></i>
                                Apply as a Service Provider
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('/') }}js/scripts.js"></script>
        <script>
            $(document).ready(function() {
                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                })
                $('.theme-loader').fadeOut('slow', function() {
                    $(this).remove();
                });
            });
        </script>

        <!---------------- Java Scripts for Map  ----------------->
        <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCioD60UKGbPyLAFK8MoAH9UqySjVb50tw&v=3&language=en"></script>-->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBa0v-1H3GAkYu21zPyN_eUuedhxoTRZdw&callback=initAutocomplete&libraries=places&v=weekly" /></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>


        <script type="text/javascript">
            var map;        
            var initMapView = false;
        
            var saloons = {!! json_encode($saloons) !!};
            var markerIcon = '{{ asset('/') }}marker.png';
            var markers = [];
            var pos = [];
        
            var defaultLat = {{ $defaultLat }};
            var defaultLong = {{ $defaultLong }};
        
            //console.log({{$saloons}});
            $('#progress').hide();
        
            function initMap() {
        
                var mapOptions = {
                    zoom: 12,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: new google.maps.LatLng(defaultLat, defaultLong)
                };
        
                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        
                //addMarker_saloon();
                //addMarker_cars();
                
                //addMarker_anjuman();
                //addMarker_route_spot();
                locate();
        
                var bounds = new google.maps.LatLngBounds();
        
                for(var i = 0; i < saloons.length; i++){
                    var position;
                    position = addMarker(saloons[i]);
                    bounds.extend(position);
                }
        
                if(saloons.length>0){
                    if(initMapView != true) {
                        map.fitBounds(bounds);
                        initMapView = true;
                    }
                }else{
                    var position = new google.maps.LatLng(parseFloat(defaultLat),parseFloat(defaultLong));
                    bounds.extend(position);
                    if(initMapView != true) {
                        map.fitBounds(bounds);
                        initMapView = true;
                    }
                }

                var input = document.getElementById('locationSearchInput');
  
                var autocomplete = new google.maps.places.Autocomplete(input,{
                                                                                componentRestrictions: { country: ["bd"] },
                                                                                fields: ["address_components", "geometry"],
                                                                            });
            
                autocomplete.addListener('place_changed', function() {
                    $('#progress').show();

                    for(var i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }
                    markers = [];

                    var place = autocomplete.getPlace();
                    //alert(place.geometry.location.lat());
                    // document.getElementById('location-snap').innerHTML = place.formatted_address;
                    var selectedLatitude = place.geometry.location.lat();
                    var selectedLongitude = place.geometry.location.lng();

                    $.ajax({
                        type: 'GET',
                        url: '/get-saloons/'+selectedLatitude+'/'+selectedLongitude,
                        dataType: "JSON",
                        success: function (response) {
                            var bounds = new google.maps.LatLngBounds();

                            var position = new google.maps.LatLng(parseFloat(selectedLatitude),parseFloat(selectedLongitude));
                            bounds.extend(position);

                            addSelectedLocationMarker(map,position);

                            if(response.length > 0){
                                $.each(response, function (key, val) { 
                                    var position;
                                    position = addMarker(val);
                                    bounds.extend(position);
                                });

                                if(initMapView != true) {
                                    map.fitBounds(bounds);
                                    initMapView = true;
                                }else{
                                    map.fitBounds(bounds);
                                    initMapView = true;
                                }
                                
                            }else{
                                //alert('nothing found! - '+selectedLatitude+','+selectedLongitude);
                                map.fitBounds(bounds);
                                initMapView = true;
                            }
                            //console.log(response.length);
                            $('#progress').hide();
                        },
                        error: function(xhr) {
                            console.log(xhr);
                        }
                    });
                });
                
            }

            function locate(){
                if ("geolocation" in navigator){
                    navigator.geolocation.getCurrentPosition(function(position){
                        var currentLatitude = position.coords.latitude;
                        var currentLongitude = position.coords.longitude;
                        //alert("Current Latitude: " + currentLatitude);

                        $.ajax({
                            type: 'GET',
                            url: '/get-saloons/'+currentLatitude+'/'+currentLongitude,
                            dataType: "JSON",
                            success: function (response) {
                                var bounds = new google.maps.LatLngBounds();
                                if(response.length > 0){
                                    $.each(response, function (key, val) { 
                                        var position;
                                        position = addMarker(val);
                                        bounds.extend(position);
                                    });

                                    if(initMapView != true) {
                                        map.fitBounds(bounds);
                                        initMapView = true;
                                    }else{
                                        map.fitBounds(bounds);
                                        initMapView = true;
                                    }
                                    
                                }else{
                                    var position = new google.maps.LatLng(parseFloat(defaultLat),parseFloat(defaultLong));
                                    bounds.extend(position);
                                    if(initMapView != true) {
                                        map.fitBounds(bounds);
                                        initMapView = true;
                                    }
                                }
                                console.log(response.length);
                                //$('#progress').hide();
                            },
                            error: function(xhr) {
                                console.log(xhr);
                            }
                        });
                    },
                    () => {
                        //$('#progress').hide();
                        //$('#saloon-data').hide();
                        //$('#saloon-data-default').show();
                    }
                    );
                }else{
                    //$('#progress').hide();
                    //$('#saloon-data').hide();
                    //$('#saloon-data-default').show();
                }
            }
        
            function addMarker(saloon){
                var id = saloon.id;
                var name = saloon.name;
                var email = saloon.email;
                var phone = saloon.phone;
                var address = saloon.address;
                var latitude = saloon.latitude;
                var longitude = saloon.longitude;
                //alert('ttt: '+id+'');
        
                var html = '<div style="margin-bottom: 10px;"><h3>' + name + '</h3>' + email +'<br/>'+phone+'<br/>'+address+'</div>';
                html += 	'<div><a href="/saloon/'+id+'" class="btn btn-sm btn-primary" style="margin: 5px;">View Details</a></div>';
        
                var markerLatlng = new google.maps.LatLng(parseFloat(latitude),parseFloat(longitude));
        
        
                var mark = new google.maps.Marker({
                    map: map,
                    position: markerLatlng,
                    icon: markerIcon
                });
                markers.push(mark);
        
                var infoWindow = new google.maps.InfoWindow;
                google.maps.event.addListener(mark, 'click', function(){
                    infoWindow.setContent(html);
                    infoWindow.open(map, mark);
                });
        
                return markerLatlng;
            }

            function addSelectedLocationMarker(map,position){
                var markerIcon = '{{ asset('/') }}marker-selected.png';

                var mark = new google.maps.Marker({
                    map: map,
                    position: position,
                    icon: markerIcon
                });
                markers.push(mark);
        
                var infoWindow = new google.maps.InfoWindow;
                google.maps.event.addListener(mark, 'click', function(){
                    // infoWindow.setContent(html);
                    infoWindow.open(map, mark);
                });
            }

            
        </script>
        {{-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap" async defer></script> --}}
        <div class="jumbotron">
        <div id="map-canvas"></div>
        </div>
        <script>
            $(document).ready(function(){
                initMap();
                setInterval(function mapload(){
                },3000);  // 3 sec
        
                setInterval(function mapload(){
                },3000);  // 3 sec
            });
        </script>
    </body>
</html>
