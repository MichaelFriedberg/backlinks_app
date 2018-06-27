<?php

namespace App;

use App\Contracts\PaymentSenderGateway;
use App\Contracts\Transactionable;
use App\Events\PaymentSent;

class PaymentSender
{
    protected $to;
    protected $gateway;
    protected $amount;

    /**
     * Payment constructor.
     * @param PaymentSenderGateway $gateway
     * @internal param \App\PaymentSender $paymentSender
     */
    public function __construct(PaymentSenderGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Set amount
     *
     * @param $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Set to
     *
     * @param $user
     */
    public function setTo(User $user)
    {
        $this->to = $user;
    }

    /**
     * Chain method for set to
     *
     * @param $user
     * @return $this
     */
    public function to(User $user)
    {
        $this->setTo($user);

        return $this;
    }

    /**
     * Chain method to set amount
     *
     * @param $amount
     * @return $this
     */
    public function amount($amount)
    {
        $amount = floatval($amount);
        $amount = round($amount, 2);

        $this->setAmount($amount);

        return $this;
    }

    /**
     * Send payment
     *
     * @param null $amount
     * @param null $to
     *
     * @return Payment
     */
    public function send($amount = null, $to = null)
    {
        $this->amount = $amount ?: $this->amount;
        $this->to = $to ?: $this->to;

        $this->gateway->send($this->amount, $this->to);

        $payment = $this->savePayment($this->gateway->getTransaction());

        event(new PaymentSent($payment));

        return $payment;
    }

    /**
     * Payment has been sent
     *
     * @param Transactionable $transaction
     * @return Payment
     */
    public function savePayment(Transactionable $transaction)
    {
        $payment = new Payment();
        $payment->user_id = $this->to->id;
        $payment->amount = $this->amount;
        $payment->setTransactionable($transaction);

        $payment->save();

        return $payment;
    }
}
