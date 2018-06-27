@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Reports
    </h1>
@stop

@push('breadcrumbs')
    <li class="active"><a href="{{ route('admin.report.index') }}">Reports</a></li>
@endpush

@section('content')
    <div class="box">
        <div class="box-header clearfix">
            <h3 class="box-title">Reports</h3>
        </div>

        <div class="box-body">
            @if (count($reports))
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Owe</th>
                        <th>Paid</th>
                        <th>Balance</th>
                        <th>Status</th>
                    </tr>

                    @foreach ($reports as $report)
                        <tr>
                            <td><a href="{{ route('admin.report.show', $report) }}">{{ $report->created_at->format('F Y') }}</a></td>
                            <td><a href="{{ route('admin.report.show', $report) }}">{{ $report->user->name }}</a></td>
                            <td>${{ $report->owe }}</td>
                            <td>${{ $report->paid }}</td>
                            <td><span class="{{ $report->balance() > 0 ? 'text-danger' : 'text-success' }}">${{ $report->balance() }}</span></td>
                            <td>
                                {{ $report->status }}
                                @if (count($report->payments))
                                    ({{ $report->payments->first()->status }})
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </table>
            @else
                <p>No reports found.</p>
            @endif
        </div>
    </div>
@stop