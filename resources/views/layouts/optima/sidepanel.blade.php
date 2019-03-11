<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div>
                        <img id="img-left-sidebar-togglemenu" src="{{ asset('img/blank.png') }}" alt="user-img" class="img-circle img-fluid">
                </div>
                <div class="dropdown">
                    <a id="left-sidebar-togglemenu" href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->full_name }} <span class="caret"></span></a>
                    <div class="dropdown-menu animated">
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
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> 
                    <a class="waves-effect waves-dark" href="{{ route('optima.dashboard') }}" aria-expanded="false">
                        <i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li> 
                    <a class="waves-effect waves-dark" href="{{ route('optima.route-documents') }}" aria-expanded="false">
                        <i class="ti-exchange-vertical"></i><span class="hide-menu">Route Documents</span>
                    </a>
                </li>
                <li class="{{ Request::is('optima/my-documents/*') ? 'active' : '' }}"> 
                    <a class="waves-effect waves-dark" href="{{ route('optima.my-documents') }}" aria-expanded="false">
                        <i class="ti-files"></i><span class="hide-menu">My Documents</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->