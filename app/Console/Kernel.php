<?php

namespace App\Console;

use App\Jobs\CheckSites;
use App\Jobs\PayUsers;
use App\Jobs\RefreshPendingPayments;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->call(function() {
             dispatch(new CheckSites());
         })->dailyAt('3:00');

        $schedule->call(function() {
            dispatch(new RefreshPendingPayments());
        })->hourly();

        $schedule->call(function() {
            dispatch(new PayUsers());
        })->weekly()
            ->wednesdays()
            ->when(function() {
                $secondWednesdayOfMonth = date('j', strtotime('second wednesday', mktime(0, 0, 0, date('n'), 1, date('Y'))));

                return date('j') == $secondWednesdayOfMonth;
            });
    }
}
