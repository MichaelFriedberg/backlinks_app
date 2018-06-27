<?php

namespace App\Listeners;

use App\Events\PaymentSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserPaymentSent implements ShouldQueue
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
     * @param  PaymentSent  $event
     * @return void
     */
    public function handle(PaymentSent $event)
    {
        $payment = $event->payment;
        $user = $payment->user;

        \Mail::send('emails.payment-sent', compact('payment', 'user'), function($m) use ($payment, $user) {
            $m->to($user->email);
            $m->subject('Payment sent');
        });
    }
}
