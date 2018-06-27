@if ($payment->success())
    <span class="text-success">Success</span>
@elseif ($payment->pending())
    <span class="text-warning">Pending ({{ $payment->transactionable->status }})</span>
@elseif ($payment->failed())
    <span class="text-danger">Failed ({{ $payment->transactionable->status }}{{ ! empty($payment->transactionable->error_message) ? ' - ' . $payment->transactionable->error_message : '' }})</span>
@else
    <span class="text-danger">Error ({{ $payment->transactionable->status }})</span>
@endif