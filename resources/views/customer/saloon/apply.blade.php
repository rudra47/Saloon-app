@extends('customer.layouts.app1')

@push('css')

<style>
    .navbar {
        margin-bottom: 0px;
    }
    .navbar-nav {
        flex-direction: inherit;
    }

    .login-block .auth-box {
        margin: 20px auto 0 auto;
        max-width: 450px;
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgb(69 90 100 / 8%);
        box-shadow: 0 1px 20px 0 rgb(69 90 100 / 8%);
        border: none;
        margin-bottom: 30px;
        background-color: #fff;
    }

    .login-block {
        padding: 30px 0;
        margin: 0 auto;
        background: #353C4E;
        background-size: cover;
        min-height: 100vh;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .card-block {
        padding: 1.25rem;
    }
    .m-b-20 {
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 1.25em;
    }
    .form-control {
        font-size: 16px;
        border-radius: 2px;
        border: 1px solid #ccc;
    }

    .pcoded[theme-layout="vertical"][vertical-layout="wide"] .pcoded-container {
        width: 100%;
        margin: 0 auto;
    }

    .pcoded[theme-layout="vertical"] .pcoded-container {
        overflow: hidden;
        position: relative;
        margin: 0 auto;
    }

    @media (min-width: 576px){
        .col-sm-12 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
@endpush

@section('content')
<!-- Header-->
@include('admin.layouts.partials.preloader')
<!-- Section-->
@include('admin.layouts.partials.preloader')

<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        @include('flash::message')
        <section class="login-block">
            <!-- Container-fluid starts -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Authentication card start -->

                        <form method="POST" action="{{ route('saloon.apply.submit') }}" class="md-float-material form-material" enctype="multipart/form-data">
                            @csrf
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Apply as a Saloon</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="name">Saloon Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Saloon Name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                                        <span class="form-bar"></span>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="email">Saloon Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" value="{{ old('email') }}" required autocomplete="off">
                                        <span class="form-bar"></span>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="phone">Saloon Phone</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone Number" value="{{ old('phone') }}" required autocomplete="off" autofocus>
                                        <span class="form-bar"></span>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="latitude">Saloon Location Latitude</label><br/>
                                        <span style="font-size:10px; color: #1726df;">*Mark you location on google map & copy the <b>Latitude</b></span>
                                        <input type="text" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" placeholder="Your Location Latitude" value="{{ old('latitude') }}" required autocomplete="off" style="margin-top: 5px;">
                                        <span class="form-bar"></span>
                                        @error('latitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="longitude">Saloon Location Longitude</label><br/>
                                        <span style="font-size:10px; color: #1726df;">*Mark you location on google map & copy the <b>Longitude</b></span>
                                        <input type="text" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" placeholder="Your Location Longitude" value="{{ old('longitude') }}" required autocomplete="off" style="margin-top: 5px;">
                                        <span class="form-bar"></span>
                                        @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="password">Saloon Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" required autocomplete="new-password">
                                        <span class="form-bar"></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required autocomplete="new-password">
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="address">Saloon Address</label>
                                        <textarea name="address" id="" class="form-control @error('address') is-invalid @enderror" placeholder="Enter Phone Full Address" cols="30" rows="5" required autocomplete="off"></textarea>
                                        <span class="form-bar"></span>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="image">Saloon Thumbnail</label>
                                        <input type="file" name="image" id="image"class="form-control @error('image') is-invalid @enderror">
                                        <span class="form-bar"></span>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="cover_image">Saloon Cover Photo</label>
                                        <input type="file" name="cover_image" id="cover_image"class="form-control @error('cover_image') is-invalid @enderror">
                                        <span class="form-bar"></span>
                                        @error('cover_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-sm-6">
                                            <a href="#"class="waves-effect waves-light text-center m-b-20" id="getLocation" style="float: right:">Get Current Location</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" style="float: right;">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- end of col-sm-12 -->
                </div>
                <!-- end of row -->
            </div>
            <!-- end of container-fluid -->
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {

        //let html = '<h5 class="text-center">No saloon found!</h5>';
        locate();

        function locate(){
            if ("geolocation" in navigator){
                navigator.geolocation.getCurrentPosition(function(position){ 
                    var currentLatitude = position.coords.latitude;
                    var currentLongitude = position.coords.longitude;

                    $('#latitude').val(currentLatitude);
                    $('#longitude').val(currentLongitude);
                });
            }
        }

        
    });
</script>

<script>
    $(document).ready(function () {

        $(document).on('click', '#getLocation', function(e) {
                e.preventDefault();
       
            if ("geolocation" in navigator){
                navigator.geolocation.getCurrentPosition(function(position){ 
                    var currentLatitude = position.coords.latitude;
                    var currentLongitude = position.coords.longitude;
                    //alert("Current Latitude: " + currentLatitude);

                    $('#latitude').val(currentLatitude);
                    $('#longitude').val(currentLongitude);
                });
            }
        

        });

        
    });
</script>
@endpush