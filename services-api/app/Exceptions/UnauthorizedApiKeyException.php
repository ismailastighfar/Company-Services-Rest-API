<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedApiKeyException extends Exception
{
    /**
     * The exception message.
     *
     * @var string
     */
    protected $message = 'Unauthorized. Invalid API key.';

    /**
     * The exception code.
     *
     * @var int
     */
    protected $code = 401;
}
