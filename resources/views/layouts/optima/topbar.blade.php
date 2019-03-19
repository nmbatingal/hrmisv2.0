<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header p-l-20">
            <a class="navbar-brand" href="{{ route('home') }}">
                <!-- Logo icon -->
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ asset('img/optima-icon.png') }}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="{{ asset('img/optima-icon.png') }}" alt="homepage" class="light-logo" />
                    <span class="p-l-20 m-0 font-bold text-center" style="color: #000000;">O P T I M A</span>
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
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> 
                    <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)">
                        <i class="icon-menu"></i>
                    </a> 
                </li>
                <li class="nav-item">
                    <form action="{{ route('optima.search') }}" method="GET" class="app-search d-none d-md-block d-lg-block">
                        <input type="text" class="form-control" name="q" placeholder="Search & enter" value="{{ request('q') }}">
                    </form>
                </li>
            </ul>
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
                <!-- mega menu -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-layout-grid2"></i></a>
                    <div class="dropdown-menu">
                        
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End mega menu -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- User Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    @guest
                    @else
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('img/blank.png') }}" width="30" alt="user" class="img-circle"></a>
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
                    @endguest
                </li>
                <!-- ============================================================== -->
                <!-- End User Profile -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Chat Bubble -->
                <!-- ============================================================== -->
                <!-- <li class="nav-item right-side-toggle"> 
                    <a class="nav-link  waves-effect waves-light" href="javascript:void(0)" title="More options"><i class="ti-arrow-right ti-arrow-left"></i></a>
                </li> -->
                <!-- ============================================================== -->
                <!-- End Chat Bubble -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>