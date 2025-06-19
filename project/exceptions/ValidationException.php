<?php

require_once 'AppException.php';

class ValidationException extends AppException
{
    public function __construct($message, $code = 422)
    {
        parent::__construct($message, $code);
    }
}
