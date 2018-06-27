<?php

namespace App\Listeners;

use Mail;
use App\Events\NewUserSignUp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminSignUp
{
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
     * @param  NewUserSignUp  $event
     * @return void
     */
    public function handle(NewUserSignUp $event)
    {
        //
        $data = $event->data;

        \Mail::send('emails.new-registration-admin-notice', $data, function($message) use ($data)
        {
            $message->from('yourbloggerbucks@gmail.com', "New Register");
            $message->subject("New Signup from ".$data['name']);
            $message->to('disla68@yahoo.com');
            $message->cc('hollywoodfl23@gmail.com');
        });

    }
}
