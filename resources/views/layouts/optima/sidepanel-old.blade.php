<div class="side-mini-panel">
    <ul class="mini-nav">
        <div class="togglediv"><a href="javascript:void(0)" id="togglebtn"><i class="ti-menu"></i></a></div>
        <!-- .Dashboard -->
        <!-- <li class="{{ Request::is('home') ? 'selected' : '' }}">
            <a href="{{ route('home') }}" title="Home"><i class="ti-home"></i></a>
        </li> -->
        <!-- /.Home -->

        <!-- DOCUMENT TRACKER -->
        <li class="{{ Request::is('doctracker/*') ? 'selected' : '' }}">
            <a href="javascript:void(0);" title="OPTIMA"><i class="mdi mdi-qrcode-scan"></i></a>
            <div class="sidebarmenu">
                <!-- Left navbar-header -->
                <h3 class="menu-title">OPTIMA</h3>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('optima.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('optima.route-documents') }}">Route Documents</a></li>
                    <li><a href="{{ route('optima.mydocuments') }}">My Documents</a></li>
                    <li><a href="javascript:void(0);">Search</a></li>
                    <!-- <li><a href="{{ route('doctracker.logs') }}">Logs</a></li> -->
                    <li><a href="{{ route('optima.about') }}">About</a></li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
        <!-- END DOCUMENT TRACKER -->

        <!-- .SYSTEM SETTINGS -->
        <li class="{{ Request::is('setting') ? 'selected' : '' }}">
            <a href="javascript:void(0)" title="Settings"><i class="ti-settings"></i></a>
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
                    <li><a href="{{ route('user.setting.index') }}">Profile Setting </a></li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
        <!-- /.Home -->
    </ul>
    <div>
        aaaasdasdasda
    </div>
</div>