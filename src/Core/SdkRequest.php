<?php

namespace QfRPC\YAFRPC\Core;

use QfRPC\YAFRPC\Auth\Singer;

class SdkRequest
{
    public function header(){
        $header = [];
        $server = $_SERVER;
        foreach ($server as $key => $val) {
            if (0 === strpos($key, 'HTTP_')) {
                $key          = str_replace('_', '-', strtolower(substr($key, 5)));
                $header[$key] = $val;
            }
        }
        return $header;
    }
    /**
     * @desc 构建请求头
     * @param $ak
     * @param $sk
     * @return array
     */
    public function buildHeader($ak, $sk)
    {
        $time = $this->getTime();
        $nonce = $this->getRandom();
        $arr= [
            'sign' => (new Singer())->sign($ak, $sk, $time, $nonce),
            'key' => $ak,
            'time' => $time,
            'nonce' => $nonce
        ];
        $headerParam=[];
        foreach($arr as $key=>$v){
            array_push($headerParam,$key.':'.$v);
        }
        return $headerParam;
    }

    /**
     * @desc 获取当前时间戳
     * @return int
     */
    public function getTime()
    {
        return time();
    }

    /**
     * @desc 获取随机数
     * @return int
     * @throws \Exception
     */
    public function getRandom()
    {
        return random_int(1000000, 9999999);
    }
}
