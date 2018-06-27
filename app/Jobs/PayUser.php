<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Payment;
use App\PaymentSender;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayUser extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (! count($this->user->sites)) {
            return true;
        }

        $report = $this->user->getReportForThisMonth();

        if ($report->balance() > 0) {
            $report->pay();
        }
    }
}
