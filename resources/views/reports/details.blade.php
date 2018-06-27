<h5>Sites</h5>
<table class="table table-condensed table-striped">
    <tr>
        <th>Site</th>
        <th class="text-center">Site Score</th>
        <th class="text-center">Days Active/30 days</th>
        <th class="text-right"></th>
    </tr>
    @foreach ($report->items as $item)
        <tr>
            <td>{{ $item->site }}</td>
            <td class="text-center">{{ $item->score }}</td>
            <td class="text-center">{{ $item->days_active }}</td>
            <td class="text-right">${{ $item->amount }}</td>
        </tr>
    @endforeach
</table>

<h5>Payments</h5>

@if (count($report->payments))
    <table class="table table-condensed table-striped">
        <tr>
            <th>Transaction ID</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Last Updated</th>
        </tr>
        @foreach ($report->payments as $payment)
            <tr>
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