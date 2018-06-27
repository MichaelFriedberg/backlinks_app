<?php

namespace App;

class PaypalApi
{
    /**
     * Get the Paypal Api context
     *
     * @return \PayPal\Rest\ApiContext
     */
    public function context()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->clientId(),     // ClientID
                $this->clientSecret()      // ClientSecret
            )
        );

        $apiContext->setConfig([
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/PayPal.log'),
            'log.LogLevel' => 'DEBUG'
        ]);

        if ($this->live()) {
            $apiContext->setConfig([
                'mode' => 'live',
                'log.LogLevel' => 'INFO'
            ]);
        }

        return $apiContext;
    }

    /**
     * Get the client id
     *
     * @return mixed
     */
    public function clientId()
    {
        return env('PAYPAL_CLIENT_ID');
    }

    /**
     * Get the client secret
     *
     * @return mixed
     */
    public function clientSecret()
    {
        return env('PAYPAL_CLIENT_SECRET');
    }

    /**
     * If PayPal mode is live
     *
     * @return bool
     */
    public function live()
    {
        return env('PAYPAL_MODE') == 'live';
    }
}