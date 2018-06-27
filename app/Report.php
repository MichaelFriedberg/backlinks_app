<?php

namespace App;

use App\Events\ReportGenerated;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
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
     * Has many report items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(ReportItem::class);
    }

    /**
     * Belongs to many payments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'report_payments');
    }

    /**
     * Generate report for site
     *
     * @param User $user
     * @return $this
     */
    public function generate(User $user)
    {
        $this->user_id = $user->id;
        $this->owe = 0;

        $reportItems = [];

        foreach ($user->sites as $site) {
            $site->updateMozScore($site);

            $reportItem = new ReportItem;
            $reportItem->generate($site);

            $reportItems[] = $reportItem;

            $this->owe += $reportItem->amount;
        }

        $this->save();

        foreach ($reportItems as $reportItem) {
            $this->items()->save($reportItem);
        }

        event(new ReportGenerated($this));

        return $this;
    }

    /**
     * Payment has been sent for this report
     *
     * @param $payment
     */
    public function paymentSent($payment)
    {
        $this->payments()->attach($payment->id);

        $this->status = 'Payment Sent';
        $this->save();
    }

    /**
     * Get balance
     *
     * @return mixed
     */
    public function balance()
    {
        return number_format($this->owe - $this->paid, 2);
    }

    /**
     * Send a payment for this report
     *
     * @param null $amount
     */
    public function pay($amount = null)
    {
        $amount = is_null($amount) ? $this->balance() : $amount;

        $payment = app(PaymentSender::class)->to($this->user)
            ->amount($amount)
            ->send();

        $this->paymentSent($payment);

        if ($payment->success()) {
            $this->paid += $payment->amount;
            $this->save();
        }

        return $payment;
    }
}
