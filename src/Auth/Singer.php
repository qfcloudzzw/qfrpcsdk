<?php

namespace QfRPC\YAFRPC\Auth;

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
}