<?php

namespace QfRPC\YAFRPC;

use QfRPC\YAFRPC\Auth\Auth;
use QfRPC\YAFRPC\Exceptions\SdkException;

class QFRpcService
{

    /**
     * @var 服务
     */
    protected $server;

    protected $openAuth;
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
        $this->openAuth = false;

    }

    public function openAuth($bool)
    {
        $this->openAuth = $bool;
        return $this;
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
        if ($this->openAuth) {
            (new Auth())->check($this->ak, $this->sk);
        }
        $this->service->handle();
    }
}