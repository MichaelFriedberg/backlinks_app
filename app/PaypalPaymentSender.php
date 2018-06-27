<?php

namespace App;

use App\Contracts\PaymentSenderGateway;
use App\Events\PaypalPaymentFailed;
use App\Exceptions\PaypalEmailNotSetException;
use PayPal\Api\PayoutItemDetails;

class PaypalPaymentSender implements PaymentSenderGateway
{
    protected $transaction;
    protected $amount;
    protected $to;

    /**
     * Send payment to user
     *
     * @param $amount
     * @param User $to
     * @return PaypalTransaction
     */
    public function send($amount, User $to)
    {
        $this->amount = $amount;
        $this->to = $to;

        $payouts = new \PayPal\Api\Payout();

        $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject($this->emailSubject());

        $payoutItem = $this->payoutItem();

        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($payoutItem);

        $output = $payouts->createSynchronous(app('paypal_api')->context());

        $item = $output->getItems()[0];

        $this->transaction = $this->createTransaction($item);

        return $this->getTransaction();
    }

    /**
     * Get email subject
     *
     * @return string
     */
    protected function emailSubject()
    {
        return 'Payment From ' . config('app.name');
    }

    /**
     * Get payout item
     *
     * @return \PayPal\Api\PayoutItem
     */
    protected function payoutItem()
    {
        $senderItem = new \PayPal\Api\PayoutItem();

        $senderItem->setRecipientType('Email')
            ->setNote('Your monthly payment.')
            ->setReceiver($this->getReceiver())
            ->setSenderItemId($this->to->id)
            ->setAmount(new \PayPal\Api\Currency('{
                    "value":"'.$this->amount.'",
                    "currency":"USD"
                }')
            );

        return $senderItem;
    }

    /**
     * Create transaction
     *
     * @param PayoutItemDetails $item
     * @return PaypalTransaction
     */
    protected function createTransaction(PayoutItemDetails $item)
    {
        $transaction = new PaypalTransaction;
        $transaction->email = $this->to->getPaypalEmail();
        $transaction->amount = $this->amount;
        $transaction->payout_item_id = $item->getPayoutItemId();
        $transaction->transaction_id = $item->getTransactionId();
        $transaction->status = $item->getTransactionStatus();

        $errors = $item->getErrors();

        if (is_array($errors)) {
            $messages = [];

            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }

            $transaction->error_message = implode(', ', $messages);
        } else {
            $transaction->error_message = $errors->getMessage();
        }

        $transaction->save();

        return $transaction;
    }

    /**
     * Get the resulting transaction after sending payment
     *
     * @return mixed
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Get receiver
     * @return mixed
     * @throws PaypalEmailNotSetException
     */
    protected function getReceiver()
    {
        $receiver = $this->to->getPaypalEmail();

        if (empty($receiver)) {
            throw new PaypalEmailNotSetException('User does not have a PayPal email set.');
        }

        return $receiver;
    }
}