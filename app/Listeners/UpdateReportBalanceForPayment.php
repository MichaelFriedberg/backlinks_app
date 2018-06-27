<?php

namespace App\Listeners;

use App\Events\PaymentRefreshed;
use App\Payment;
use App\Report;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateReportBalanceForPayment
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PaymentRefreshed $event
     */
    public function handle(PaymentRefreshed $event)
    {
        $payment = $event->payment;
        $original = $event->original;

        if ($payment->success() && $original['status'] == Payment::STATUS_PENDING) {
            $report = Report::whereHas('payments', function ($query) use ($payment) {
                $query->where('payments.id', $payment->id);
            })->first();

            if ($report) {
                $report->paid += $payment->amount;
                $report->save();
            }
        }
    }
}
