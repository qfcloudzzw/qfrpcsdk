<?php

namespace Qfcloud\AuthCenter\Auth;

use Qfcloud\AuthCenter\Core\SdkRequest;
use Qfcloud\AuthCenter\Exceptions\SdkException;

class Auth{
    public function check($ak,$sk){
        $header=(new SdkRequest())->header();
        $time=$header['time'];
        $nonce=$header['nonce'];
        if(time()-$header['time']>300) throw new SdkException('签名过期');

        $sign= (new Singer())->sign($ak,$sk,$time,$nonce);
        if($sign != $header['sign']) throw new SdkException('签名错误');
    }
}