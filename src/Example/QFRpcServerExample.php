<?php
require '../../vendor/autoload.php';

use QfRPC\YAFRPC\QFRpcService;

class DemoClass
{
    public function getList($page_no, $page_size)
    {
        return [$page_no, $page_size];
    }

    public function getInfo($id)
    {
        return [$id];
    }
}

$ak = "9624cd0312cc2f1ad4fcc47366ca116c";
$sk = "1acd91b8de88864baee20f998a985b5c1cfde75e503341bc4752be06c966a53d";

(new QFRpcService($ak, $sk))
    ->createServerClass(DemoClass::class)
    ->openAuth(true)
    ->run();



