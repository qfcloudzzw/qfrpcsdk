<?php

namespace QfRPC\YARRPC;

use GuzzleHttp\Psr7\Rfc7230;
use QfRPC\YARRPC\Core\RpcRequest;
use QfRPC\YARRPC\Core\CreateResponseBody;
use QfRPC\YARRPC\Handler\ClientExceptionHandler;
use QfRPC\YARRPC\Handler\RequestHandler;
use QfRPC\YARRPC\Core\RpcResponse;
use QfRPC\YARRPC\Exceptions\ClientException;

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
     * @请求地址
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
    public function send($action, $body)
    {

        //请求体校验
        if (!$body instanceof RpcRequest) {
            throw new ClientException('not allow request body');
        }

        //请求校验
        try {
            $response = $this->client->call($action, [$body->getBody()]);
        } catch (\Exception  $e) {
            print(PHP_EOL.'--error--'. $e->getMessage().'--error--'.PHP_EOL);
            throw new ClientException('rpc reqeust fail!');
        }
        //响应体校验
        if (!$response instanceof RpcResponse) {
            throw new ClientException('not allow response body');
        }

        return $response;
    }


    /**
     * @desc 创建请求参数
     * @return RpcRequest
     * @author zhaozhiwei
     * @time 2024/1/2-10:42
     */
    public static function CreateRpcRequest()
    {
        return new RpcRequest();
    }

    /**
     * @desc 创建响应参数
     * @return RpcRequest
     * @author zhaozhiwei
     * @time 2024/1/2-10:42
     */
    public static function CreateRpcResponse()
    {
        return new RpcResponse();
    }

    /**
     * @desc 设置链接超时时间
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
        $headerParam = (new RequestHandler())->buildHeader($this->ak, $this->sk);
        $this->client->SetOpt(YAR_OPT_HEADER, $headerParam);
    }
}