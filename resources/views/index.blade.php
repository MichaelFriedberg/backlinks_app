@extends('layouts.app')

@section('content')
    <div class="content-box-header">
        <div class="panel-title">Dashboard</div>
    </div>

    <div class="content-box-large box-with-header">
        <div class="dashboard-sites clearfix">
<style>
    .payout{
        color:#02025d;
        padding-left: 1.5em;
        font-size: 62px;
        margin-top: 0px;
        margin-bottom: 0px;
    }
    .green{
        background-color: rgba(156, 255, 158, 0.4);
    }
</style>
            <div class="col-sm-4">
                <div class="dashboard-site green">


                    <div class="site-details">

                        @if(count($reports))
                        @foreach ($reports as $report)

                                <span class="payout">${{ $report->paid }}</span>
                            @endforeach

                        @else

                        <h1 class="payout">$0</h1>
                        @endif
                       <strong>Payout</strong>
                    </div>
                </div>
            </div>



            @if (count(Auth::user()->sites))
                @foreach (Auth::user()->sites as $site)
                    <div class="col-sm-4">
                        <div class="dashboard-site">
                            <h5>{{ $site->name }}</h5>

                            <div class="site-details">
                                <p>
                                    Status:
                                    @if ($site->latestStatus)
                                        @if ($site->latestStatus->status)
                                            <span class="text-success">Active</span>
                                        @else
                                            <span class="text-danger">Error</span>
                                        @endif
                                    @else
                                        <span class="text-warning">Unknown</span>
                                    @endif
                                </p>

                                <p>
                                    @if ($site->latestStatus)
                                        {{ $site->latestStatus->created_at->diffForHumans() }}
                                    @else
                                        Not yet checked
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>You have no sites set up. <a href="{{ route('site.create') }}">Add a site</a></p>
            @endif
        </div>
    </div>
@endsection
