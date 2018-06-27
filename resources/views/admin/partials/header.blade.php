<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('admin.index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>B</b>B</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">BloggerBucks Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        @if (Auth::guard('admin')->check())
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('/admin/logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        @endif
    </nav>
</header>