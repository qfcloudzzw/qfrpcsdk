<?php

namespace QfRPC\YARRPC\Core;

class RpcResponse
{
    protected $code;
    protected $message;
    protected $data;

    public function __construct()
    {
        $this->code=200;
        $this->message='success';
        $this->data=[];
    }

    /**
     * @desc 设置响应数据
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @desc 设置状态码
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @desc 设置响应信息
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @desc 获取响应状态码
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @desc 获取响应信息
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @desc 获取数据
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}