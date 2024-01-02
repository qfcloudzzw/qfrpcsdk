<?php

namespace QfRPC\YARRPC;

use QfRPC\YARRPC\Auth\Auth;
use QfRPC\YARRPC\Exceptions\SdkException;

class QFRpcService
{

    /**
     * @param $class
     * @throws SdkException
     */
    public function __construct($class)
    {

        $this->service = new \Yar_Server(new $class);
        return $this;

    }

    /**
     * @desc 创建服务类
     * @param $class
     * @return $this
     */
    public function allowAppList($list)
    {
        (new Auth())->checkAuth($list);
        $this->app_list=$list;
        return $this;
    }

    /**
     * @desc 启动服务
     * @return void
     */
    public function run()
    {
        $this->service->handle();
    }
}