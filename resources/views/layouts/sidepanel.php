<li class="{{ Request::is('hr/*') ? 'selected' : '' }}">
            <a href="javascript:void(0)"><i class="icon-people"></i></a>
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
                    <li class="menu {{ Request::is('hr/applicants/*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" 
                           class="{{ Request::is('hr/applicants/*') ? 'active' : '' }}
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