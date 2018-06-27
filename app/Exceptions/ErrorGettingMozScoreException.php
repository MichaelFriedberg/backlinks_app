<?php

namespace App\Exceptions;

class ErrorGettingMozScoreException extends \Exception
{
    /**
     * ErrorGettingMozScoreException constructor.
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}