<?php

namespace QfRPC\YARRPC\Core;

/**
 * @创建请求参数体类
 */
class CreateResponseBody
{

    /**
     * @响应状态码
     */
    protected $code;

    /**
     * @响应信息
     */
    protected $message;
    protected $data;

    /**
     * @构建方法
     */
    public function __construct($response)
    {
        $responseJson = json_decode($response, true);
        $this->code = $responseJson['code'];
        $this->message = $responseJson['message'] ?? ($responseJson['msg'] ?? '');
        $this->data = $responseJson['data'];
    }

    /**
     * @desc setCode
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @desc setMessage
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->code = $message;
        return $this;
    }

    /**
     * @desc setData
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->code = $data;
        return $this;
    }

    /**
     * @desc  getCode
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @desc getMessage
     * @return mixed|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @desc getData
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}