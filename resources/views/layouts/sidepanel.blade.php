<div class="side-mini-panel">
    <ul class="mini-nav">
        <div class="togglediv"><a href="javascript:void(0)" id="togglebtn"><i class="ti-menu"></i></a></div>
        <!-- .Dashboard -->
        <li>
            <a href="javascript:void(0)"><i class="ti-home"></i></a>
            <div class="sidebarmenu">
                <!-- Left navbar-header -->
                <h3 class="menu-title">Home</h3>
                <!-- <div class="searchable-menu">
                    <form role="search" class="menu-search">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </div> -->
                <ul class="sidebar-menu">
                    <li><a href="{{ url('/home') }}">Dashboard </a></li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
        <!-- /.Home -->
        <!-- .Apps -->
        <li class="
                {{ Request::is('hr/*') ? 'selected' : '' }}
            "><a href="javascript:void(0)"><i class="icon-people"></i></a>
            <div class="sidebarmenu">
                <!-- Left navbar-header -->
                <h3 class="menu-title">HR-Applicants</h3>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('applicants.dashboard') }}">Dashboard</a></li>
                    <li class="menu">
                        <a href="javascript:void(0)" 
                           class="
                                {{ Request::is('hr/positions/*') ? 'active' : '' }}
                           ">Positions <i class="fa fa-angle-left float-right"></i></a>
                        <!-- .Second level -->
                        <ul class="sub-menu"
                            {{ Request::is('hr/positions/*') ? 'style=display:block;' : '' }}
                            >
                            <li><a href="{{ route('applicants.list') }}">List of Applicants</a></li>
                        </ul>
                        <!-- /.Second level -->
                    </li>
                    <li class="menu">
                        <a href="javascript:void(0)" 
                           class="
                                {{ Request::is('hr/applicants/*') ? 'active' : '' }}
                           ">Applicants <i class="fa fa-angle-left float-right"></i></a>
                        <!-- .Second level -->
                        <ul class="sub-menu"
                            {{ Request::is('hr/applicants/*') ? 'style=display:block;' : '' }}
                            >
                            <li><a href="{{ route('applicants.list') }}">List of Applicants</a></li>
                            <li><a href="{{ route('applicants.create') }}">Add Applicant</a></li>
                        </ul>
                        <!-- /.Second level -->
                    </li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
    </ul>
</div>