<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('/') }}images/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('/') }}css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{ route('home') }}">Smart Saloon</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('map') }}">Map</a></li>
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
                                    <li><a class="dropdown-item" href="#!"><i class="bi-filter-right me-1"></i> My Bookings</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi-person-fill me-1"></i> My Profile</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi-box-arrow-left me-1"></i></i> Logout</a>
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
                                Apply as a Saloon
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
        </footer>
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
    </body>
</html>