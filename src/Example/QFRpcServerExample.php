<?php
require '../../rpc-autoload.php';

use QfRPC\YARRPC\QFRpcService;
use QfRPC\YARRPC\Core\RpcResponse;
class Demo
{
    /**
     * @item  $name string
     * @item  $name string
     * @return RpcResponse
     */
    public function getTestPageList($params)
    {
        
        $list=[
            ['id'=>1,'name'=>'test1'],
            ['id'=>2,'name'=>'test2'],
            ['id'=>3,'name'=>'test3'],
        ];
        $res=(new RpcResponse())->setData($list)->setCode(201);
        return $res;
    }
}


$server=(new QFRpcService(Demo::class))
    ->allowItem('9624cd0312cc2f1ad4fcc47366ca116c1','1acd91b8de88864baee20f998a985b5c1cfde75e503341bc4752be06c966a53d')
    ->allowItem('9624cd0312cc2f1ad4fcc47366ca116c2','1acd91b8de88864baee20f998a985b5c1cfde75e503341bc4752be06c966a53d')
    ->run();






