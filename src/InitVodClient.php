<?php

namespace Zach\Aliyun;

require_once './aliyun-php-sdk/aliyun-php-sdk-core/Config.php';

use vod\Request\V20170321 as vod;

class InitVodClient
{
    /**
     * 初始化客户端
     * @param $accessKeyId
     * @param $accessKeySecret
     * @return \DefaultAcsClient
     */
    function init_vod_client($accessKeyId, $accessKeySecret) {
        $regionId = 'cn-shanghai';  // 点播服务所在的Region，国内请填cn-shanghai，不要填写别的区域
        $profile = \DefaultProfile::getProfile($regionId, $accessKeyId, $accessKeySecret);
        return new \DefaultAcsClient($profile);
    }
}