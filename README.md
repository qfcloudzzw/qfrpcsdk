# QFRPC SDK for PHP

## 安装

* 推荐使用 `composer` 进行安装。可以使用 composer.json 声明依赖，或者运行下面的命令。
```bash
$ composer require  qfrpc/yarrpc
```
* 直接下载安装，但需要参照 composer 的 autoloader，增加一个自己的 autoloader 程序。

## 运行环境

| QFRPC SDK版本 |        PHP 版本         |
|:-----------:|:---------------------:|
|     1.x     | yar extension,   7.0+ |

```php
创建RPC服务
...
use QfRPC\YARRPC\QFRpcService;
...
$ak = '*** Provide your Access Key ***';
$sk = '*** Provide your Secret Key ***';

示例demo类
class Demo
{
    public function test($params)
    {
        return $params;
    }
}

创建服务并运行

(new QFRpcService($ak, $sk))
    ->createServerClass(Demo::class)
    ->run();
...
```
```php
创建RPC服务
...
use QfRPC\YARRPC\QFRpcClient;
use QfRPC\YARRPC\Exceptions\SdkException;
...
$ak = '*** Provide your Access Key ***';
$sk = '*** Provide your Secret Key ***';
$endpoint = 'https://your-endpoint-uri';

示例demo类
$client = (new QFRpcClient($ak, $sk))
    ->withEndpoint($endpoint)
    ->newBuilder();

$params = $client::CreateRequestParams()
    ->add('page_no', 1)
    ->add('page_size', 10);
print('---获取测试数据---');

$action_name='test';
$list = $client->send($action_name, $params)->parseResponse();

if ($list->getCode() == 200) {
    var_dump($list->getData());
} else {
    echo 'error';
}

var_dump($list);
```