<header class="topbar" style="background: #edf1f5;">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">
                <!-- Logo icon -->
                <b>
                    <h3 style="color: #000000">MyApp&nbsp;<small class="text-muted">Account</small></h3> 
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!-- <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                    Light Logo icon
                    <img src="{{ asset('assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" /> -->
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
            <ul class="navbar-nav mr-auto">
                <li class="d-none d-md-block d-lg-block">
                    <a href="javascript:void(0)" class="p-l-20">
                        <!--This is logo text-->
                        <!-- <img src="{{ asset('assets/images/logo-light-text.png') }}" alt="home" class="light-logo" alt="home" /> -->
                    </a>
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
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Messages" style="color: #000000"> <i class="ti-email"></i>
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
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Notifications" style="color: #000000"> <i class="ti-bell"></i>
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
                <!-- mega menu -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown m-l-20"> 
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #000000"><i class="ti-layout-grid2"></i></a>
                    <div class="dropdown-menu dropdown-menu-right mailbox p-0">
                        <ul>
                            <li>
                                <div class="message-center">
                                    <a href="{{ route('home') }}">
                                        <div class="user-img m-0"> 
                                            <img src="" alt="home" class="img-fluid">
                                        </div>
                                        <div class="mail-contnet align-middle">
                                            <h5>Home</h5>
                                        </div>
                                    </a>
                                    <a href="{{ route('optima.index') }}">
                                        <div class="user-img m-0"> 
                                            <img src="{{ asset('img/optima-icon.png') }}" alt="optima" class="img-fluid">
                                        </div>
                                        <div class="mail-contnet align-middle">
                                            <h5>Optima</h5>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
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
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('img/blank.png') }}" alt="user" class=""></a>
                    @endguest
                    
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- Profile Setting -->
                        <a href="{{ route('myaccount.index') }}" class="dropdown-item"><i class="ti-settings"></i> My Account</a>
                        <!-- User Activity Log -->
                        <a href="{{ route('myaccount.log', Auth::user()->id) }}" class="dropdown-item"><i class="ti-list"></i> My Activity</a>
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
                <!-- <li class="nav-item right-side-toggle"> 
                    <a class="nav-link  waves-effect waves-light" href="javascript:void(0)" title="More options"><i class="icon-options-vertical"></i></a>
                </li> -->
                <!-- ============================================================== -->
                <!-- End Chat Bubble -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>