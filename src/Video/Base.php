<?php

namespace Zach\Aliyun\Video;

use http\Exception\BadMessageException;

require_once __DIR__.'/../aliyun-php-sdk/aliyun-php-sdk-core/Config.php';   // 假定您的源码文件和aliyun-php-sdk处于同一目录

class Base
{
    function init_vod_client($accessKeyId, $accessKeySecret) {
        $regionId = 'cn-shanghai';  // 点播服务所在的Region，国内请填cn-shanghai，不要填写别的区域
        $profile = \DefaultProfile::getProfile($regionId, $accessKeyId, $accessKeySecret);

        return new \DefaultAcsClient($profile);
    }

    public function validateInput(array $input,array $requiredList)
    {
        foreach ($requiredList as $required => $value) {
            if (empty($input[$required])) {
                throw new \BadMethodCallException($value);
            }
        }

        return true;
    }
}