<?php

namespace QfRPC\YARRPC\Exceptions;


use QfRPC\YARRPC\Handler\ServerExceptionHandler;

class ServerException extends \Exception{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        (new ServerExceptionHandler($message,$code))->render();
    }
}