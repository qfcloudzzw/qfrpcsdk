<?php

namespace QfRPC\YARRPC\Core;

/**
 * @创建请求参数体类
 */
class RpcRequest
{
    /**
     * @请求体
     */
    protected $body;

    /**
     * @构建方法
     */
    public function __construct()
    {
        $this->body = [];
    }

    /**
     * @desc 添加方法
     * @param $key
     * @param $value
     * @return $this
     */
    public function addItem($key, $value)
    {
        $this->body[$key]=$value;
        return $this;
    }

    /**
     * @desc 获取请求体内容
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

}