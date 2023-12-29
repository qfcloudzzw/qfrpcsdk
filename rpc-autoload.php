<?php


$mapping = [
    'QfRPC\YARRPC\QFRpcClient' => __DIR__ . '/QfRPC/YARRPC/QFRpcClient.php',
    'QfRPC\YARRPC\QFRpcService' => __DIR__ . '/QfRPC/YARRPC/QFRpcService.php',
    'QfRPC\YARRPC\Core\SdkRequest' => __DIR__ . '/QfRPC/YARRPC/Core/SdkRequest.php',
    'QfRPC\YARRPC\Core\SdkResponse' => __DIR__ . '/QfRPC/YARRPC/Core/SdkResponse.php',
    'QfRPC\YARRPC\Auth\Auth' => __DIR__ . '/QfRPC/YARRPC/Auth/Auth.php',
    'QfRPC\YARRPC\Auth\Singer' => __DIR__ . '/QfRPC/YARRPC/Auth/Singer.php',
    'QfRPC\YARRPC\Exceptions\SdkException' => __DIR__ . '/QfRPC/YARRPC/Exceptions/SdkException.php',
];


spl_autoload_register(function ($class) use ($mapping) {
    if (isset($mapping[$class])) {
        require $mapping[$class];
    }
}, true);