<?php

namespace QfRPC\YARRPC\Auth;

use QfRPC\YARRPC\Core\SdkRequest;

class Singer
{

    /**
     * @desc 签名计算方法
     * @param $ak
     * @param $sk
     * @param $timestamp
     * @param $nonce
     * @return string
     */
    public function sign($ak, $sk, $timestamp, $nonce)
    {
        $str = $sk . "appId" . $ak . "timestamp" . $timestamp . $nonce;
        return base64_encode(md5($str));
    }

    /**
     * @desc 验证签名
     * @param $whiteList
     * @return void
     */
    public function verifySign($whiteList)
    {
        $header = (new SdkRequest())->header();
        $ak = $header['key'];
        $sk = '';
        if (!empty($whiteList)) {
            foreach ($whiteList as $v) {
                if ($v['ak'] == $ak) {
                    $sk = $v['sk'];
                }
            }
        }
        $time = $header['time'];
        $nonce = $header['nonce'];
        if (time() - $header['time'] > 300) {
            throw  (new \Yar_Server_Exception());
        }

        $sign = $this->sign($ak, $sk, $time, $nonce);

        if ($sign != $header['sign']) {
            throw  (new \Yar_Server_Exception());
        }
    }
}