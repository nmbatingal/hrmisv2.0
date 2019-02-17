<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ asset('img/optima-icon.png') }}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="{{ asset('img/optima-icon.png') }}" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav p-r-20 m-r-40">
                <li class="d-none d-md-block d-lg-block">
                    <a href="{{ route('home') }}" class="p-l-20">
                        <!--This is logo text-->
                        <!-- <img src="{{ asset('assets/images/logo-light-text.png') }}" alt="home" class="light-logo" alt="home" /> -->
                        <h3 class="text-white p-l-20 m-0">OPTIMA</h3>
                    </a>
                </li>
            </ul>
            <div class="navbar-nav mr-auto">
                <!-- <form class="form-horizontal">
                    <input type="text" class="form-control" style="width: 500px;" placeholder="Search & enter">
                </form> -->
            </div>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Message -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Messages"> <i class="ti-email"></i>
                        <!-- <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox">
                        <ul>
                            <li>
                                <div class="drop-title">Messages <span class="badge badge-info">0</span></div>
                            </li>
                            <li>
                                <div class="message-center">
                                </div>
                            </li>
                            <li>
                                <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all messages</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Message -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Notification -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Notifications"> <i class="ti-bell"></i>
                        <!-- <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox">
                        <ul>
                            <li>
                                <div class="drop-title">Notifications <span class="badge badge-info">0</span></div>
                            </li>
                            <li>
                                <div class="message-center">
                                </div>
                            </li>
                            <li>
                                <a class="nav-link text-center link" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Notification -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- User Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    @guest
                    @else
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('img/blank.png') }}" alt="user" class=""> </a>
                    @endguest
                    
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0)" class="dropdown-item"><b>&#64;{{ Auth::user()->username }}</b></a>
                        <div class="dropdown-divider"></div>
                        <!-- Profile Setting -->
                        <a href="{{ route('user.setting.index') }}" class="dropdown-item"><i class="ti-settings"></i> Profile Setting</a>
                        <!-- User Activity Log -->
                        <a href="{{ route('user.setting.log', Auth::user()->id) }}" class="dropdown-item"><i class="ti-list"></i> Activity Log</a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="{{ route('logout') }}" class="dropdown-item text-danger" 
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i> Logout</a>
                        <!-- text-->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End User Profile -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Chat Bubble -->
                <!-- ============================================================== -->
                <li class="nav-item right-side-toggle"> 
                    <a class="nav-link  waves-effect waves-light" href="javascript:void(0)" title="More options"><i class="ti-arrow-right ti-arrow-left"></i></a>
                </li>
                <!-- ============================================================== -->
                <!-- End Chat Bubble -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>