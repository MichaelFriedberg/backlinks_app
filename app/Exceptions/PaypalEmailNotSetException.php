<?php

namespace App\Exceptions;

class PaypalEmailNotSetException extends \Exception
{
    /**
     * PaypalEmailNotSet constructor.
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}