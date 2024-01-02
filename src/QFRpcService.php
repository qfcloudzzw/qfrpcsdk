<?php

namespace QfRPC\YARRPC;

use QfRPC\YARRPC\Auth\Auth;
use QfRPC\YARRPC\Exceptions\SdkException;

class QFRpcService
{
    protected $ak;
    protected $sk;

    /**
     * @desc 初始化方法
     * @param $ak
     * @param $sk
     * @throws SdkException
     */
    public function __construct($ak, $sk)
    {
        $this->ak = $ak;
        $this->sk = $sk;
//        if ($_SERVER['REQUEST_METHOD'] != 'GET'){
            (new Auth())->check($this->ak, $this->sk);
//        }

    }


    /**
     * @desc 创建服务类
     * @param $class
     * @return $this
     */
    public function createServerClass($class)
    {
        $this->service = new \Yar_Server(new $class);
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