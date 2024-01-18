<?php

namespace QfRPC\YARRPC\Exceptions;


use QfRPC\YARRPC\Handler\ClientExceptionHandler;

class ClientException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        (new ClientExceptionHandler($message,$code))->render();
    }
}