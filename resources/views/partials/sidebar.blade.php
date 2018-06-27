<div class="sidebar content-box" style="display: block;">
    <ul class="nav">
        <!-- Main menu -->
        <li class="{{ request()->is('/') ? 'current' : '' }}"><a href="/"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
        <li class="{{ request()->is('report*') ? 'current' : '' }}"><a href="{{ route('reports.index') }}"><i class="fa fa-line-chart"></i> Reports</a></li>
        <li class="submenu open">
            <a href="#">
                <i class="glyphicon glyphicon-globe"></i> Sites
                <span class="caret pull-right"></span>
            </a>
            <!-- Sub menu -->
            <ul class="site-menu">
                @foreach (Auth::user()->sites as $site)
                    <li class="{{ request()->url() == route('site.show', $site) ? 'current' : '' }}">
                        <a href="{{ route('site.show', $site) }}">{{ $site->name }}</a>
                    </li>
                @endforeach
                <li class="{{ request()->route()->getName() == 'site.create' ? 'current' : '' }}"><a href="{{ route('site.create') }}">+ Add a Site</a></li>
            </ul>
        </li>
        <li class="{{ request()->route()->getName() == 'wordpress' ? 'current' : '' }}"><a href="{{ route('wordpress') }}"><i class="fa fa-wordpress"></i> WP Plugin</a></li>
    </ul>
</div>