@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Report Details
    </h1>
@stop

@push('breadcrumbs')
<li class="active"><a href="{{ route('admin.report.index') }}">Reports</a></li>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="box">
                <div class="box-header clearfix">
                    <h3 class="box-title">Report Details</h3>
                </div>

                <div class="box-body">
                    <p><strong>Generated:</strong> {{ $report->created_at->format('F Y') }}</p>
                    <p><strong>User:</strong> <a href="{{ route('admin.user.edit', $report->user) }}">{{ $report->user->name }}</a></p>
                    <p><strong>Status:</strong> {{ $report->status }}</p>

                    <p>&nbsp;</p>

                    <table class="table table-hover table-striped">
                        <tr>
                            <th>Site</th>
                            <th class="text-center">Site Score</th>
                            <th class="text-center">Days Active/30 days</th>
                            <th class="text-right">Balance</th>
                        </tr>
                        @foreach ($report->items as $item)
                            <tr>
                                <td>{{ $item->site }}</td>
                                <td class="text-center">{{ $item->score }}</td>
                                <td class="text-center">{{ $item->days_active }}</td>
                                <td class="text-right">${{ $item->amount }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="3"><strong>Total Owed:</strong></td>
                            <td class="text-right"><strong>${{ $report->owe }}</strong></td>
                        </tr>

                        <tr>
                            <td colspan="3"><strong>Total Paid:</strong></td>
                            <td class="text-right"><strong>${{ $report->paid }}</strong></td>
                        </tr>

                        <tr>
                            <td colspan="3"><strong>Balance:</strong></td>
                            <td class="text-right"><strong>${{ $report->balance() }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="box-header clearfix">
                    <h3 class="box-title">Payments</h3>
                </div>

                <div class="box-body">
                    @if (count($report->payments))
                        <table class="table table-condensed table-striped">
                            <tr>
                                <th>Payment ID</th>
                                <th>Transaction ID</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Last Updated</th>
                            </tr>
                            @foreach ($report->payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->transactionable->getTransactionId() }}</td>
                                    <td>
                                        @include('admin.report.payment-status')
                                    </td>
                                    <td>${{ $payment->amount }}</td>
                                    <td>{{ $payment->updated_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>No payments found.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="box">
                <div class="box-header clearfix">
                    <h3 class="box-title">Send a Payment</h3>
                </div>

                <div class="box-body">
                    @if ($report->user->paypal_email)
                        <form class="form form-horizontal payment-form" action="{{ route('admin.report.pay', $report) }}" method="POST">
                            {!! csrf_field() !!}

                            {{-- Amount --}}
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="to" class="col-sm-2 control-label">Amount:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                        <input class="form-control" type="text" name="amount" value="{{ old('amount', $report->balance() > 0 ? $report->balance() : '0.00') }}">
                                    </div>

                                    @if ($errors->has('amount'))
                                        <div class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- To --}}
                            <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                                <label for="to" class="col-sm-2 control-label">To:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $report->user->paypal_email }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10 text-right">
                                    <button class="btn btn-primary" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <p>User does not have a PayPal email set.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $('.payment-form').submit(function() {
        $(this).find('button').prop('disabled', true);
        $(this).find('button').append('&nbsp;&nbsp; <i class="fa fa-circle-o-notch fa-spin fa-fw"></i>');
    });
</script>
@endpush