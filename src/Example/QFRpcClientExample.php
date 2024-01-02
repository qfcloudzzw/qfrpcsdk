<?php

require '../../rpc-autoload.php';

use QfRPC\YARRPC\QFRpcClient;
use QfRPC\YARRPC\Exceptions\SdkException;


$ak = "9624cd0312cc2f1ad4fcc47366ca116c1";
$sk = "1acd91b8de88864baee20f998a985b5c1cfde75e503341bc4752be06c966a53d";

//可访问的server文件地址(如果地址有效，浏览器访问会出现yar
$endpoint = 'http://127.0.0.1/QFRpcServerExample.php';

$client = (new QFRpcClient($ak, $sk))
    ->withEndpoint($endpoint)
    ->newBuilder();

$params = $client::CreateRequestParams()
    ->add('page_no', 1)
    ->add('page_size', 10);
print('---获取测试数据---');

try {
    $list = $client->send('test', $params);
} catch (SdkException $e) {
    var_dump($e->getMessage());
    die;
}

var_dump($list);


exit;