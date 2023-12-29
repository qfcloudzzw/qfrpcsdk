<?php

require '../../vendor/autoload.php';
use Qfcloud\AuthCenter\QFRpcClient;


$ak = "9624cd0312cc2f1ad4fcc47366ca116c";
$sk = "1acd91b8de88864baee20f998a985b5c1cfde75e503341bc4752be06c966a53d";

//可访问的server文件地址(如果地址有效，浏览器访问会出现yar
$endpoint='http://127.0.0.1:8555/QFRpcServerExample.php';

$client = (new QFRpcClient($ak,$sk))
    ->withEndpoint($endpoint)
    ->newBuilder();
print('---获取列表数据---');
$list = $client->send('getList',[1,10]);
var_dump($list);

print('---获取详情数据---');
$info = $client->send('getInfo',[1]);
var_dump($info);

exit;