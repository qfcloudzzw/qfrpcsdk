<?php

namespace QfRPC\YARRPC\Exceptions;


class SdkException
{

    protected $code;
    protected $message;
    protected $data;

    public function __construct($message='error', $code=500, $data=[])
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getData()
    {
        return $this->data;
    }

}