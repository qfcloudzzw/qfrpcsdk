<?php

namespace QfRPC\YARRPC\Handler;

class ClientExceptionHandler
{
    protected $code;
    protected $message;
    protected $data;


    public function __construct($message = "", $code = 0)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function render()
    {
        error_reporting(0);
        $data = ['code' => $this->code, 'message' => $this->message, 'data' => []];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}