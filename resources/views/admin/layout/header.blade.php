<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ Auth::user()->image }}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                {{ Auth::user()->full_name }} <i class="mdi mdi-chevron-down"></i>
                </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a href="{{ route('profile.index') }}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Profile</span>
                    </a>
                    <!-- item-->
                    <form action="{{ route('admin.logOut') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.php" class="logo logo-dark text-center">
            <span class="logo-sm">
            <img src="{{ asset('assets/admin/images/logo-white.png') }}" alt="" height="38px">
            </span>
            </a>
            <a href="index.php" class="logo logo-light text-center">
            <span class="logo-sm">
            <img src="{{ asset('assets/admin/images/logo-sm.png') }}" alt="" height="38px">
            </span>
            <span class="logo-lg">
            <img src="{{ asset('assets/admin/images/logo-white.png') }}" alt="" height="38px">
            </span>
            </a>
        </div>
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
                </button>
            </li>
            <li>
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>