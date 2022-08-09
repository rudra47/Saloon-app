<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ Request::is('dashboard') ? 'active pcoded-trigger' : '' }} ">
                <a href="{{ route('app.dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->role_type == 'admin')
            <li class="{{ Request::is('dashboard') ? 'active pcoded-trigger' : '' }} ">
                <a href="{{ route('app.admin.saloons') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Saloons</span>
                </a>
            </li>
            <li class="{{ Request::is('dashboard') ? 'active pcoded-trigger' : '' }} ">
                <a href="{{ route('app.admin.customers') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Customer</span>
                </a>
            </li>

            @endif
            @if(auth()->user()->role_type == 'saloon')
            <li class="{{ Request::is('saloon/service') ? 'active pcoded-trigger' : '' }} ">
                <a href="{{ route('app.saloon.service.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Services</span>
                </a>
            </li>
            <li class="{{ Request::is('saloon/bookings') ? 'active pcoded-trigger' : '' }} ">
                <a href="{{ route('app.saloon.bookings.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Bookings</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>
