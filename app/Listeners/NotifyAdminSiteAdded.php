<?php

namespace App\Listeners;
use Mail;
use App\User;
use App\Events\NewSiteAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminSiteAdded
{
    //use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $website;
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewSiteAdded  $event
     * @return void
     */
    public function handle(NewSiteAdded $event)
    {
        //

        $website = $event->website;
        $username = User::find($website->user_id);
        $website = $website->url;
        $email = $username->email;
        $name = $username->name;

        \Mail::send('emails.new-site-notice', compact('website','name','email'), function($message) use ($website,$email,$name)
        {
            $message->from('yourbloggerbucks@gmail.com', "New Site");
            $message->subject("New Site");
           $message->to('disla68@yahoo.com');
            $message->to('hollywoodfl23@gmail.com');
        });

    }
}
