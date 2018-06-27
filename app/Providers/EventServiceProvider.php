<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\PaymentRefreshed' => [
            'App\Listeners\UpdateReportBalanceForPayment',
        ],
        'App\Events\SiteNotActive' => [
            'App\Listeners\NotifyUserSiteNotActive'
        ],
        'App\Events\ReportGenerated' => [
            'App\Listeners\NotifyUserReportGenerated'
        ],
        'App\Events\PaymentSent' => [
            'App\Listeners\NotifyUserPaymentSent'
        ],
	'App\Events\NewUserSignUp' => [
	    'App\Listeners\NotifyAdminSignUp'
	],
	'App\Events\NewSiteAdded' => [
            'App\Listeners\NotifyAdminSiteAdded'
	],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
