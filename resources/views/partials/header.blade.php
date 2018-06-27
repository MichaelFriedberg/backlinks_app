<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="/">BloggerBucks<p id="org">.org</p></a></h1>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                @if (Auth::check())
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="caret"></b></a>
                                    <ul class="dropdown-menu animated fadeInUp">
                                        <li><a href="{{ route('user.edit') }}">Settings</a></li>
                                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                                    </ul>
                                @else
                                    <li><a href="{{ url('/login') }}">Login</a></li>
                                    <li><a href="{{ url('/register') }}">Register</a></li>
                                @endif
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
