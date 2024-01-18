<?php

namespace QfRPC\YARRPC;

use QfRPC\YARRPC\Auth\Auth;
use QfRPC\YARRPC\Auth\Singer;
use QfRPC\YARRPC\Auth\WhiteList;
use QfRPC\YARRPC\Exceptions\SdkException;
use QfRPC\YARRPC\Exceptions\ServerException;

class QFRpcService
{
    protected $whiteList;

    protected $_instance;
  
    public function __construct($class)
    {
        $this->_instance = new \Yar_Server(new $class);

        $this->whiteList = [];
        return $this;

    }

    /**
     * @desc 配置权限秘钥对
     * @param $ak
     * @param $sk
     */
    public function allowItem($ak, $sk)
    {
        array_push($this->whiteList, ['ak' => $ak, 'sk' => $sk]);
        return $this;
    }

    /**
     * @desc 启动服务
     * @return void
     */
    public function run()
    {
        if (!empty($this->whiteList) && strtoupper($_SERVER['REQUEST_METHOD']) != 'GET') {
            (new Singer())->verifySign($this->whiteList);
        }
        $this->_instance->handle();
    }

}