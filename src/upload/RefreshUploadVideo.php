<?php

namespace Zach\Aliyun\upload;

require_once '../aliyun-php-sdk/aliyun-php-sdk-core/Config.php';

use vod\Request\V20170321 as vod;

class RefreshUploadVideo
{
    /**
     * 刷新视频上传凭证
     * @param $client
     * @param $videoId
     * @return mixed
     */
    function refresh_upload_video($client, $videoId) {
        $request = new vod\RefreshUploadVideoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }
}