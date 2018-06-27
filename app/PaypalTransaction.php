<?php

namespace App;

use App\Contracts\Transactionable;
use Illuminate\Database\Eloquent\Model;

class PaypalTransaction extends Model implements Transactionable
{
    /**
     * Update transaction details from payment gateway
     *
     * @return mixed
     */
    public function refresh()
    {
        $output = \PayPal\Api\PayoutItem::get($this->payout_item_id, app('paypal_api')->context());

        $this->status = $output->getTransactionStatus();

        $this->save();
    }

    /**
     * If transaction completed successfully
     *
     * @return mixed
     */
    public function success()
    {
        return in_array($this->status, [
            'SUCCESS'
        ]);
    }

    /**
     * If transaction is pending
     *
     * @return mixed
     */
    public function pending()
    {
        return in_array($this->status, [
            'NEW',
            'ONHOLD',
            'PENDING',
            'UNCLAIMED'
        ]);
    }

    /**
     * If transaction failed
     *
     * @return mixed
     */
    public function failed()
    {
        return in_array($this->status, [
            'BLOCKED',
            'DENIED',
            'FAILED',
            'RETURNED'
        ]);
    }

    /**
     * Get the transaction id
     *
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }
}
