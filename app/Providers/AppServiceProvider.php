<?php

namespace App\Providers;

use App\Contracts\PaymentSenderGateway;
use App\PaypalApi;
use App\PaypalPaymentSender;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('paypal_api', PaypalApi::class);
        $this->app->bind(PaymentSenderGateway::class, PaypalPaymentSender::class);
    }
}
