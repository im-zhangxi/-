<?php

namespace Zach\Aliyun\upload;

require_once '../aliyun-php-sdk/aliyun-php-sdk-core/Config.php';

use vod\Request\V20170321 as vod;

class CreateUploadImage
{
    /**
     * 获取图片上传地址和凭证
     * @param $client
     * @param $imageType
     * @param $imageExt
     * @return mixed
     */
    function create_upload_image($client, $imageType, $imageExt) {
        $request = new vod\CreateUploadImageRequest();
        $request->setImageType($imageType);
        $request->setImageExt($imageExt);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }
}