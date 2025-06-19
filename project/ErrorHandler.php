<?php

require_once 'Logger.php';
require_once 'exceptions/ValidationException.php';
require_once 'exceptions/DatabaseException.php';

class ErrorHandler
{
    public static function register()
    {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleError']);
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    public static function handleException(Throwable $e)
    {
        Logger::log($e);

        if ($e instanceof AppException) {
            http_response_code($e->getCode());
            echo json_encode($e->toArray());
        } else {
            http_response_code(500);
            echo json_encode([
                'error' => true,
                'message' => 'Unexpected error occurred',
            ]);
        }
    }

    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    public static function handleShutdown()
    {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR])) {
            $e = new ErrorException(
                $error['message'],
                0,
                $error['type'],
                $error['file'],
                $error['line']
            );
            self::handleException($e);
        }
    }
}
