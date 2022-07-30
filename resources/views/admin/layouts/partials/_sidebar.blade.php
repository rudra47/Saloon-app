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
            <li class="{{ Request::is('dashboard') ? 'active pcoded-trigger' : '' }} ">
                <a href="{{ route('app.dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Saloons</span>
                </a>
            </li>
            <li class="{{ Request::is('dashboard') ? 'active pcoded-trigger' : '' }} ">
                <a href="{{ route('app.dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Customer</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
