<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header text-center ml-2">
            <img src="{{ asset('img/logo.png') }}" style="height: 80px !important;" alt="...">
            <br>
            <strong class="text-muted" style="font-size: 17px;">Indomaret Parking</strong>
        </div>
        <div class="navbar-inner mt-5">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                            <i class="fas fa-home text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->role == '1')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('masterUser') ? 'active' :''}}" href="/master/user">
                            <i class="fas fa-database text-primary"></i>
                            <span class="nav-link-text">Masters</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('parkirMasuk') ? 'active':''}}" href="/parkir/masuk">
                            <i class="fas fa-parking text-primary"></i>
                            <span class="nav-link-text">Parkir Karyawan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('transactionIn') ? 'active':''}}" href="/parkir/masuk/non-karyawan">
                            <i class="fas fa-parking text-primary"></i>
                            <span class="nav-link-text">Parkir Non Karyawan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('report') ? 'active':''}}" href="/report">
                            <i class="fas fa-clipboard-list text-primary"></i>
                            <span class="nav-link-text">Laporan</span>
                        </a>
                    </li>

                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
                            <i class="fas fa-sign-out-alt text-danger"></i>
                            <span class="nav-link-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>