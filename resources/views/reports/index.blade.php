@extends('layouts.app')

@section('content')
    <div class="content-box-header">
        <div class="panel-title">Reports</div>
    </div>

    <div class="content-box-large box-with-header">
        @if (count($reports))
            <table class="table reports-table">
                <tr>
                    <th>Date</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th></th>
                </tr>

                @foreach ($reports as $report)
                    <tr data-report-id="{{ $report->id }}">
                        <td>{{ $report->created_at->format('F Y') }}</td>
                        <td>{{ $report->user->name }}</td>
                        <td>${{ $report->owe }}</td>
                        <td>
                            <span class="{{ $report->balance() > 0 ? 'text-danger' : 'text-success' }}">${{ $report->paid }}</span>
                        </td>
                        <td>
                            {{ $report->status }}
                            @if (count($report->payments))
                                ({{ $report->payments->first()->status }})
                            @endif
                        </td>
                        <td class="text-right">
                            <i class="fa fa-plus toggle-report-details" aria-hidden="true"></i>
                        </td>
                    </tr>
                    <tr id="report-details-{{ $report->id }}" class="report-details">
                        <td colspan="7">
                            @include('reports.details')
                        </td>
                    </tr>
                @endforeach

            </table>
        @else
            <p>No reports found. Reports are generated once every month.</p>
        @endif
    </div>
@endsection

@section('footer-js')
    @parent

    <script>
        $('.reports-table > tbody > tr').click(function() {
            toggleReportDetails($(this).data('report-id'));

            console.log($(this));

            var icon = $(this).find('.toggle-report-details');
            console.log(icon);

            if (icon.hasClass('fa-plus')) {
                icon.removeClass('fa-plus');
                icon.addClass('fa-minus');
            } else {
                icon.removeClass('fa-minus');
                icon.addClass('fa-plus');
            }
        });

        function toggleReportDetails(reportId) {
            var details = $('#report-details-' + reportId);

            if (details.is(':visible')) {
                details.hide();
            } else {
                details.show();
            }
        }
    </script>
@stop