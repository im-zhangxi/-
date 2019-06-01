<?php

namespace Zach\Aliyun\Video;

use vod\Request\V20170321 as vod;

class Play extends Base
{
    /**
     * 获取播放地址
     * @param $client
     * @param $videoId
     * @return mixed
     */
    function get_play_info($client, $videoId, $formats = 'mp4', $authTimeout = 3600) {
        $request = new vod\GetPlayInfoRequest();
        $request->setVideoId($videoId);
        $request->setFormats($formats);
        $request->setAuthTimeout($authTimeout);    // 播放地址过期时间（只有开启了URL鉴权才生效），默认为3600秒，支持设置最小值为3600秒
        $request->setAcceptFormat('JSON');

        return $client->getAcsResponse($request);
    }

    /**
     * 获取播放凭证
     * @param $client
     * @param $videoId
     * @return mixed
     */
    function get_play_auth($client, $videoId, $authInfoTimeout = 3000) {
        $request = new vod\GetVideoPlayAuthRequest();
        $request->setVideoId($videoId);
        $request->setAuthInfoTimeout($authInfoTimeout);  // 播放凭证过期时间，默认为100秒，取值范围100~3600；注意：播放凭证用来传给播放器自动换取播放地址，凭证过期时间不是播放地址的过期时间
        $request->setAcceptFormat('JSON');
        $response = $client->getAcsResponse($request);

        return $response;
    }
}