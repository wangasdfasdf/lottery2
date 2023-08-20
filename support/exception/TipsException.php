<?php


namespace support\exception;

use Exception;
use Throwable;

class TipsException extends Exception
{
    public function __construct($message = "", $code = 5001, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
