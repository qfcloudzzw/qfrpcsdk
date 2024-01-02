<?php

namespace QfRPC\YARRPC\Auth;

use QfRPC\YARRPC\Core\SdkRequest;
use QfRPC\YARRPC\Exceptions\SdkException;

class Auth
{
    public function checkAuth($app_list)
    {
        $allow_key = $_SERVER['REQUEST_METHOD'] != 'GET';
        if ($allow_key) {

            $header = (new SdkRequest())->header();
            $ak = $header['key'];
            $sk='';
            if (!empty($app_list)) {
                foreach ($app_list as $v) {
                    if ($v['ak'] == $ak) {
                        $sk = $v['sk'];
                    }
                }

            }

            $time = $header['time'];
            $nonce = $header['nonce'];
            if (time() - $header['time'] > 300) throw new SdkException('签名过期');

            $sign = (new Singer())->sign($ak, $sk, $time, $nonce);
            if ($sign != $header['sign']) throw new SdkException('签名错误');
        }
    }
}