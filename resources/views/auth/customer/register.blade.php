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

                        <form method="POST" action="{{ route('register') }}" class="md-float-material form-material">
                            @csrf

                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Sign Up</h3>
                                        </div>
                                    </div>
                                    @if($errors->any())
                                        {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                                    @endif
                                    <div class="form-group form-primary">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
            
                                    <div class="form-group form-primary">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group form-primary">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" placeholder="Your Location Latitude" value="{{ old('latitude') }}" required autocomplete="off">
                                        <span class="form-bar"></span>
                                        @error('latitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" placeholder="Your Location Longitude" value="{{ old('longitude') }}" required autocomplete="off">
                                        <span class="form-bar"></span>
                                        @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
            
                                    <div class="form-group form-primary">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
            
                                    <div class="form-group form-primary">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="row m-t-30">
                                        <div class="col-md-6">
                                            <a href="#"class="waves-effect waves-light text-center m-b-20" id="getLocation" style="float: right:">Get Current Location</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" style="float: right;">{{ __('Submit') }}</button>
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