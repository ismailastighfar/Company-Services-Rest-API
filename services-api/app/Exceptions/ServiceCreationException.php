<?php

namespace App\Exceptions;

use Exception;

class ServiceCreationException extends Exception
{
    protected $message = 'Failed to create the service.';
    protected $code = 500;
}
