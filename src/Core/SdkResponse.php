<?php

namespace Qfcloud\AuthCenter\Core;

class SdkResponse
{

    /**
     * @desc 解析响应数据
     * @param $response
     * @return mixed
     */
    public function analysisResponse($response)
    {
        $content = $response->getBody()->getContents();
        return json_decode($content, true);
    }
}