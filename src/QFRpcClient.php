<?php

namespace QfRPC\YARRPC;

use QfRPC\YARRPC\Core\SdkRequest;
use QfRPC\YARRPC\Exceptions\SdkException;

class QFRpcClient
{
    /**
     * @appID
     */
    protected $ak;

    /**
     * @app秘钥
     */
    protected $sk;

    /**
     * @域名
     */
    protected $endpoint;

    /**
     * @客户端
     */
    protected $client;

    /**
     * @param $ak
     * @param $sk
     */
    public function __construct($ak, $sk)
    {
        $this->ak = $ak;
        $this->sk = $sk;
    }

    /**
     * @desc 定义请求地址
     * @param $endpoint
     * @return $this
     */
    public function withEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @desc 构建客户端
     * @return $this
     */
    public function newBuilder()
    {
        $this->client = new \Yar_Client($this->endpoint);
        $this->setConnectTimeOut(2000);
        $this->setTimeOut(5000);
        $this->setHeader();
        return $this;
    }

    /**
     * @desc 发送请求
     * @param $action
     * @param $params
     * @return mixed
     */
    public function send($action, $params)
    {
        try {
            $result = $this->client->call($action, $params);
        } catch (SdkException $e) {
            throw new SdkException($e->getMessage());
        }
        return $result;
    }

    /**
     * @desc 设置连接时间
     * @param $mic
     * @return void
     */
    public function setConnectTimeOut($mic)
    {
        $this->client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, $mic);
    }

    /**
     * @desc 设置超时时间
     * @param $mic
     * @return void
     */
    public function setTimeOut($mic)
    {
        $this->client->SetOpt(YAR_OPT_TIMEOUT, $mic);
    }

    /**
     * @desc 设置请求头
     * @return void
     */
    public function setHeader()
    {
        $headerParam = (new SdkRequest())->buildHeader($this->ak, $this->sk);
        $this->client->SetOpt(YAR_OPT_HEADER, $headerParam);
    }
}