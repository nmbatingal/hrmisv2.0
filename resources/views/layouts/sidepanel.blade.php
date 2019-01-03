<div class="side-mini-panel">
    <ul class="mini-nav">
        <div class="togglediv"><a href="javascript:void(0)" id="togglebtn"><i class="ti-menu"></i></a></div>
        <!-- .Dashboard -->
        <li class="{{ Request::is('home') ? 'selected' : '' }}">
            <a href="{{ route('home') }}"><i class="ti-home"></i></a>
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
                    <li><a href="{{ route('home') }}">Home </a></li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
        <!-- /.Home -->

        <!-- DOCUMENT TRACKER -->
        <li class="{{ Request::is('doctracker/*') ? 'selected' : '' }}">
            <a href="javascript:void(0);"><i class="mdi mdi-qrcode-scan"></i></a>
            <div class="sidebarmenu">
                <!-- Left navbar-header -->
                <h3 class="menu-title">OPTIMA System</h3>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('doctracker.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('doctracker.mydocuments') }}">My Documents</a></li>
                    <li><a href="{{ route('doctracker.incoming') }}">Incoming Documents</a></li>
                    <li><a href="{{ route('doctracker.outgoing') }}">Outgoing Documents</a></li>
                    <li><a href="{{ route('doctracker.logs') }}">Logs</a></li>
                    <li><a href="{{ route('doctracker.about') }}">About</a></li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
        <!-- END DOCUMENT TRACKER -->

        @hasrole('System Administrator')
        <!-- MORALE SURVEY  -->
        <li class="{{ Request::is('moralesurvey/*') ? 'selected' : '' }}">
            <a href="javascript:void(0);"><i class="ti-bar-chart"></i></a>
            <div class="sidebarmenu">
                <!-- Left navbar-header -->
                <h3 class="menu-title">Morale Survey</h3>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('moralesurvey.dashboard') }}">Dashboard</a></li>
                    <li class="menu {{ Request::is('hr/applicants/*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" 
                           class="{{ Request::is('moralesurvey/setting/*') ? 'active' : '' }}
                           ">Survey Settings <i class="fa fa-angle-left float-right"></i></a>
                        <!-- .Second level -->
                        <ul class="sub-menu"
                            {{ Request::is('moralesurvey/setting/*') ? 'style=display:block;' : '' }}
                            >
                            <li><a href="{{ route('question.index') }}">Questions</a></li>
                            <li><a href="{{ route('semester.index') }}">Semester</a></li>
                        </ul>
                        <!-- /.Second level -->
                    </li>
                    <li><a href="{{ route('survey.index') }}">Survey Form</a></li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
        <!-- END MORALE SURVEY  -->
        @endhasrole

        <!-- .SYSTEM SETTINGS -->
        <li class="{{ Request::is('setting') ? 'selected' : '' }}">
            <a href="{{ route('all.setting.index') }}"><i class="ti-settings"></i></a>
            <div class="sidebarmenu">
                <!-- Left navbar-header -->
                <h3 class="menu-title">System Setting</h3>
                <!-- <div class="searchable-menu">
                    <form role="search" class="menu-search">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </div> -->
                <ul class="sidebar-menu">
                    <li><a href="{{ route('all.setting.index') }}">All Settings </a></li>
                    <li><a href="{{ route('user.setting.index') }}">Account Setting </a></li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
        <!-- /.Home -->
    </ul>
</div>