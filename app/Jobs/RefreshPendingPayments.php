<?php

namespace App\Jobs;

use App\Events\PaymentRefreshed;
use App\Jobs\Job;
use App\Payment;
use Event;
use Illuminate\Queue\SerializesModels;

class RefreshPendingPayments extends Job
{
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pendingPayments = Payment::wherePending()->get();

        foreach ($pendingPayments as $payment) {
            $original = $payment->getOriginal();

            $payment->refresh();

            Event::fire(new PaymentRefreshed($payment, $original));
        }
    }
}
