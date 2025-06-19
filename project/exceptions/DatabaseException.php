<?php

require_once 'AppException.php';

class DatabaseException extends AppException
{
    public function __construct($message, $code = 500)
    {
        parent::__construct($message, $code);
    }
}
