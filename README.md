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

为什么要用此工具包?
1.yar缺少权限验证，本工具包在构建和调用时就加入了秘钥和签名验证，保证了rpc调用的安全性
2.rpc传递参数需要统一，本工具包提供了rpc请求体和响应体，减少请求参数、请求体的多样化，增强数据调试对接效率，增强了代码统一规范

```php
创建RPC服务
...
use QfRPC\YARRPC\QFRpcService;
use QfRPC\YARRPC\Core\RpcResponse;
...
$ak = '*** Provide your Access Key ***';
$sk = '*** Provide your Secret Key ***';

示例demo类

class Demo
{
    public function getTestPageList($params)
    {
        $list=[
            ['id'=>1,'name'=>'test1'],
            ['id'=>2,'name'=>'test2'],
            ['id'=>3,'name'=>'test3'],
        ];
        //构建rpc响应体
        $res=(new RpcResponse())->setCode(200)->setMessage('success')->setData($params);
        return $res;
    }
}
$client=(new QFRpcService(Demo::class))//创建RPC服务类
    ->allowItem('other1 Access Key','other1 Secret Key')//设置允许应用1的ak,sk
    ->allowItem('other2 Access Key','other2 Secret Key')//设置允许应用2的ak,sk
    ->run();//启动服务
...
```
```php
调用RPC服务
...
use QfRPC\YARRPC\QFRpcClient;
...
$ak = '*** Provide your Access Key ***';
$sk = '*** Provide your Secret Key ***';
$endpoint = 'https://your-endpoint-uri';

示例demo类
$client = (new QFRpcClient($ak, $sk))
    ->withEndpoint($endpoint)
    ->newBuilder();

$params = $client::CreateRpcRequest()
    ->addItem('page_no', 1)
    ->addItem('page_size', 10);

$list = $client->send('getTestPageList', $params);

if ($list->getCode() == 200) {
    var_dump($list->getData());
} else {
    echo $list->getMessage();
}

```
