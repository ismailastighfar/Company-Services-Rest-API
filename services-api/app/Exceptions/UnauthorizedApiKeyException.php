<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedApiKeyException extends Exception
{
    protected $message = 'Unauthorized. Invalid API key.';

    protected $code = 401;
}
