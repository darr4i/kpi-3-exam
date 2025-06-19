<?php

require_once 'ErrorHandler.php';
ErrorHandler::register();

require_once 'exceptions/ValidationException.php';
require_once 'exceptions/DatabaseException.php';

function checkInput($data)
{
    if (empty($data['email'])) {
        throw new ValidationException('Email is required');
    }
}

function connectToDatabase()
{
    $connected = false;
    if (!$connected) {
        throw new DatabaseException('Unable to connect to database');
    }
}

function buggyCode()
{
    $x = 5 / 0;
}

try {
    checkInput([]);             // Soft
    connectToDatabase();        // Operational
    buggyCode();                // Code error
} catch (Exception $e) {
    throw $e;
}
