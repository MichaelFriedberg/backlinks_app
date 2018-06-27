@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Sites
    </h1>
@stop

@push('breadcrumbs')
<li class="active"><a href="{{ route('admin.site.index') }}">Sites</a></li>
@endpush

@section('content')
    <div class="box">
        <div class="box-header clearfix">
            <h3 class="box-title">All Sites</h3>
        </div>

        <div class="box-body">
            @if (count($sites))
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Last Checked</th>
                        <th width="200"></th>
                    </tr>

                    @foreach ($sites as $site)
                        <tr>
                            <td><a href="{{ route('admin.site.edit', $site) }}">{{ $site->name }}</a></td>
                            <td>
                                @if ($site->latestStatus)
                                    @if ($site->latestStatus->status)
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Error</span>
                                    @endif
                                @else
                                    <span class="text-warning">Unknown</span>
                                @endif
                            </td>
                            <td>
                                @if ($site->latestStatus)
                                    {{ $site->latestStatus->created_at->diffForHumans() }}
                                @else
                                    Not yet checked
                                @endif
                            </td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ $site->url }}" target="_blank">View <i class="fa fa-external-link"></i></a>
                                    <span>&nbsp;|&nbsp;</span>
                                    <a href="{{ route('admin.site.edit', $site) }}">Edit</a>
                                    <span>&nbsp;|&nbsp;</span>
                                    <a href="{{ route('admin.site.confirm-delete', $site) }}" class="text-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </table>
            @else
                <p>No sites found.</p>
            @endif
        </div>
    </div>
@stop