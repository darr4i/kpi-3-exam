<?php

class AppException extends Exception
{
    public function __construct($message, $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function toArray()
    {
        return [
            'error' => true,
            'message' => $this->getMessage(),
            'code' => $this->getCode()
        ];
    }
}
