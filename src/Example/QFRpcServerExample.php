<?php
require '../../rpc-autoload.php';

use QfRPC\YARRPC\QFRpcService;

class Demo
{
    public function test($params)
    {
        return json_encode(['code'=>200,'msg'=>'success','data'=>$params]);
    }
}

$ak = "9624cd0312cc2f1ad4fcc47366ca116c";
$sk = "1acd91b8de88864baee20f998a985b5c1cfde75e503341bc4752be06c966a53d";

(new QFRpcService($ak, $sk))
    ->createServerClass(Demo::class)
    ->run();



