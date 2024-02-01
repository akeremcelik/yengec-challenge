<?php

namespace App\Exceptions;

use Exception;

class UnsuccessfulResponseException extends Exception
{
    protected $message = 'Unsuccessful response';
    protected $code = 400;
}
