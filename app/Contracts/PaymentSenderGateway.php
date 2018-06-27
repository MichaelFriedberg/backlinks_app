<?php

namespace App\Contracts;

use App\User;

interface PaymentSenderGateway
{
    /**
     * @param $amount
     * @param User $to
     */
    public function send($amount, User $to);

    /**
     * Get the resulting transaction after sending payment
     *
     * @return mixed
     */
    public function getTransaction();
}