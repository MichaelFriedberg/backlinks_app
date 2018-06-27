<?php

namespace App\Listeners;

use App\Events\SiteNotActive;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserSiteNotActive implements ShouldQueue
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
     * @param  SiteNotActive  $event
     * @return void
     */
    public function handle(SiteNotActive $event)
    {
        $site = $event->site;
        $user = $site->user;

        \Mail::send('emails.site-not-active', compact('site', 'user'), function($m) use ($site, $user) {
            $m->to($user->email);
            $m->subject(config('app.name') . ' links not active on ' . $site->name);
        });
    }
}
