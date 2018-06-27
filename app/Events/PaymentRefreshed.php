<?php

namespace App\Events;

use App\Events\Event;
use App\Payment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PaymentRefreshed extends Event
{
    use SerializesModels;

    public $payment;
    public $original;

    /**
     * Create a new event instance.
     *
     * @param Payment $payment
     */
    public function __construct(Payment $payment, $original)
    {
        $this->payment = $payment;
        $this->original = $original;
    }
}
