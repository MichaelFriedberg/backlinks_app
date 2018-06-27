<?php

namespace App;

use App\Contracts\Transactionable;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STATUS_SUCCESS = 'success';
    const STATUS_PENDING = 'pending';
    const STATUS_FAILED = 'failed';
    const STATUS_ERROR = 'error';

    /**
     * Belongs to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function transactionable()
    {
        return $this->morphTo();
    }

    /**
     * Set the transaction
     *
     * @param Transactionable $transaction
     */
    public function setTransactionable(Transactionable $transaction)
    {
        $this->transactionable()->associate($transaction);

        $this->status = $this->getStatusFromTransaction($transaction);
    }

    /**
     * @param $transaction
     * @return string
     */
    public function getStatusFromTransaction($transaction)
    {
        if ($transaction->success()) {
            return static::STATUS_SUCCESS;
        } elseif ($transaction->pending()) {
            return static::STATUS_PENDING;
        } elseif ($transaction->failed()) {
            return static::STATUS_FAILED;
        } else {
            return static::STATUS_ERROR;
        }
    }

    /**
     * If status is success
     *
     * @return bool
     */
    public function success()
    {
        return $this->status == static::STATUS_SUCCESS;
    }

    /**
     * If status is pending
     *
     * @return bool
     */
    public function pending()
    {
        return $this->status == static::STATUS_PENDING;
    }

    /**
     * If status is failed
     *
     * @return bool
     */
    public function failed()
    {
        return $this->status == static::STATUS_FAILED;
    }

    /**
     * If status is error
     *
     * @return bool
     */
    public function error()
    {
        return $this->status == static::STATUS_ERROR;
    }

    /**
     * Scope for pending payments
     *
     * @param $query
     * @return mixed
     */
    public function scopeWherePending($query)
    {
        return $query->where('status', static::STATUS_PENDING);
    }

    /**
     * Refresh this payment
     */
    public function refresh()
    {
        $this->transactionable->refresh();

        $this->status = $this->getStatusFromTransaction($this->transactionable);

        $this->save();
    }
}