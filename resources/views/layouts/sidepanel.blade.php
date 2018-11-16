<div class="side-mini-panel">
    <ul class="mini-nav">
        <div class="togglediv"><a href="javascript:void(0)" id="togglebtn"><i class="ti-menu"></i></a></div>
        <!-- .Dashboard -->
        <li class="{{ Request::is('home') ? 'selected' : '' }}">
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
                    <li><a href="{{ route('home') }}">Dashboard </a></li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
        <!-- /.Home -->
        <!-- .Apps -->
        <li class="{{ Request::is('doctracker/*') ? 'selected' : '' }}">
            <a href="javascript:void(0)"><i class="mdi mdi-qrcode-scan"></i></a>
            <div class="sidebarmenu">
                <!-- Left navbar-header -->
                <h3 class="menu-title">Document Tracker</h3>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('doctracker.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('doctracker.mydocuments') }}">My Documents</a></li>
                    <li><a href="{{ route('doctracker.receivedDocuments') }}">Incoming Documents</a></li>
                    <li><a href="{{ route('doctracker.receivedDocuments') }}">Outgoing Documents</a></li>
                    <li><a href="{{ route('doctracker.logs') }}">Logs</a></li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
    </ul>
</div>