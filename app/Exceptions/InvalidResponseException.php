<?php

namespace App\Exceptions;

use Exception;

class InvalidResponseException extends Exception
{
    protected $message = 'Invalid response';
    protected $code = 400;
}
