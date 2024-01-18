<?php

namespace QfRPC\YARRPC\Handler;

class ServerExceptionHandler
{
    protected $code;
    protected $message;

    public function __construct($message = "", $code = 0)
    {
        $this->code = $code;
        $this->message = $message;
    }

    public function render()
    {
        error_reporting(0);
        $data = ['code' => $this->code, 'message' => $this->message, 'data' => []];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}