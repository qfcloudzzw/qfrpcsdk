<?php


$mapping = [
    'QfRPC\YARRPC\QFRpcClient' => __DIR__ . '/src/QFRpcClient.php',
    'QfRPC\YARRPC\QFRpcService' => __DIR__ . '/src/QFRpcService.php',
    'QfRPC\YARRPC\Core\SdkRequest' => __DIR__ . '/src/Core/SdkRequest.php',
    'QfRPC\YARRPC\Core\CreateRequestBody' => __DIR__ . '/src/Core/CreateRequestBody.php',
    'QfRPC\YARRPC\Core\SdkResponse' => __DIR__ . '/src/Core/SdkResponse.php',
    'QfRPC\YARRPC\Auth\Auth' => __DIR__ . '/src/Auth/Auth.php',
    'QfRPC\YARRPC\Auth\Singer' => __DIR__ . '/src/Auth/Singer.php',
    'QfRPC\YARRPC\Exceptions\SdkException' => __DIR__ . '/src/Exceptions/SdkException.php',
];


spl_autoload_register(function ($class) use ($mapping) {
    if (isset($mapping[$class])) {
        require $mapping[$class];
    }
}, true);