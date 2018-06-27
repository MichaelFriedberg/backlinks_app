<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            @if (Auth::guard('admin')->check())
                <li class="{{ Request::is('admin') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a>
                </li>
                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.edit') }}"><i class="fa fa-cogs"></i> <span>Settings</span></a>
                </li>
                <li class="{{ Request::is('admin/link*') ? 'active' : '' }}">
                    <a href="{{ route('admin.link.index') }}"><i class="fa fa-link"></i> <span>Links</span></a>
                </li>
                <li class="{{ Request::is('admin/pricepoint*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pricepoint.index') }}"><i class="fa fa-usd"></i> <span>Price Points</span></a>
                </li>
                <li class="{{ Request::is('admin/user*') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}"><i class="fa fa-users"></i> <span>Users</span></a>
                </li>
                <li class="{{ Request::is('admin/site*') ? 'active' : '' }}">
                    <a href="{{ route('admin.site.index') }}"><i class="glyphicon glyphicon-globe"></i> <span>Sites</span></a>
                </li>
                <li class="{{ Request::is('admin/report*') ? 'active' : '' }}">
                    <a href="{{ route('admin.report.index') }}"><i class="fa fa-line-chart"></i> <span>Reports</span></a>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>