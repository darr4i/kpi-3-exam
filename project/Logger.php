<?php

class Logger
{
    public static function log(Exception $e)
    {
        $log = [
            'time' => date('Y-m-d H:i:s'),
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => self::sanitizeTrace($e->getTrace()),
        ];

        file_put_contents('error.log', json_encode($log, JSON_UNESCAPED_SLASHES) . PHP_EOL, FILE_APPEND);
    }

    private static function sanitizeTrace($trace)
    {
        foreach ($trace as &$frame) {
            unset($frame['args']); 
        }
        return $trace;
    }
}
