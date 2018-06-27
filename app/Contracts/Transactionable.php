<?php

namespace App\Contracts;

interface Transactionable
{
    /**
     * Update transaction details from payment gateway
     *
     * @return mixed
     */
    public function refresh();

    /**
     * If transaction completed successfully
     *
     * @return mixed
     */
    public function success();

    /**
     * If transaction is pending
     *
     * @return mixed
     */
    public function pending();

    /**
     * If transaction failed
     *
     * @return mixed
     */
    public function failed();

    /**
     * Get the transaction id
     *
     * @return mixed
     */
    public function getTransactionId();
}