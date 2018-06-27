<?php

namespace App\Listeners;

use App\Events\ReportGenerated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserReportGenerated implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReportGenerated  $event
     * @return void
     */
    public function handle(ReportGenerated $event)
    {
        $report = $event->report;
        $user = $report->user;

        \Mail::send('emails.report-generated', compact('report', 'user'), function($m) use ($report, $user) {
            $m->to($user->email);
            $m->subject('A new report has been generated');
        });
    }
}
