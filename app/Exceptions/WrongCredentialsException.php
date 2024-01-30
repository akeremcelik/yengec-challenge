<?php

namespace App\Exceptions;

use Exception;

class WrongCredentialsException extends Exception
{
    protected $message = 'Wrong credentials';
    protected $code = 400;
}
