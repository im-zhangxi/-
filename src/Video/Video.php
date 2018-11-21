<?php

namespace Zach\Aliyun\Video;

use vod\Request\V20170321 as vod;

class Video extends Base
{
    /**
     * 获取视频信息
     * @param $client
     * @param $videoId
     * @return mixed
     */
    function get_video_info($client, $videoId) {
        $request = new vod\GetVideoInfoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**修改视频信息
     * @param $client
     * @param $videoId
     * @return mixed
     */
    function update_video_info($client, $videoId) {
        $request = new vod\UpdateVideoInfoRequest();
        $request->setVideoId($videoId);
        $request->setTitle('New Title');   // 更改视频标题
        $request->setDescription('New Description');    // 更改视频描述
        $request->setCoverURL('http://img.alicdn.com/tps/TB1qnJ1PVXXXXXCXXXXXXXXXXXX-700-700.png');  // 更改视频封面
        $request->setTags('tag1,tag2');    // 更改视频标签，多个用逗号分隔
        $request->setCateId(0);       // 更改视频分类(可在点播控制台·全局设置·分类管理里查看分类ID：https://vod.console.aliyun.com/#/vod/settings/category)
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 删除视频
     * @param $client
     * @param $videoIds
     * @return mixed
     */
    function delete_videos($client, $videoIds) {
        $request = new vod\DeleteVideoRequest();
        $request->setVideoIds($videoIds);   // 支持批量删除视频；videoIds为传入的视频ID列表，多个用逗号分隔
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 获取源文件信息（含原片下载地址）
     * @param $client
     * @param $videoId
     * @return mixed
     */
    function get_mezzanine_info($client, $videoId) {
        $request = new vod\GetMezzanineInfoRequest();
        $request->setVideoId($videoId);
        $request->setAuthTimeout(3600*5);   // 原片下载地址过期时间，单位：秒，默认为3600秒
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 获取视频列表
     * @param $client
     * @return mixed
     */
    function get_video_list($client) {
        $request = new vod\GetVideoListRequest();
        // 示例：分别取一个月前、当前时间的UTC时间作为筛选视频列表的起止时间
        $localTimeZone = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $utcNow = gmdate('Y-m-d\TH:i:s\Z');
        $utcMonthAgo = gmdate('Y-m-d\TH:i:s\Z', time() - 30*86400);
        date_default_timezone_set($localTimeZone);
        $request->setStartTime($utcMonthAgo);   // 视频创建的起始时间，为UTC格式
        $request->setEndTime($utcNow);          // 视频创建的结束时间，为UTC格式
        #$request->setStatus('Uploading,Normal,Transcoding');  // 视频状态，默认获取所有状态的视频，多个用逗号分隔
        #$request->setCateId(0);               // 按分类进行筛选
        $request->setPageNo(1);
        $request->setPageSize(20);
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }

    /**
     * 批量获取视频根据videoIds
     * @param $client
     * @param $videoIds
     * @return mixed
     */
    function get_video_infos($client, $videoIds)
    {
        $request = new vod\GetVideoInfosRequest();

        $request->setVideoIds($videoIds);
        $request->setAcceptFormat('JSON');

        return $client->getAcsResponse($request);
    }

    /**
     * 删除媒体流
     * 可删除视频流或音频流信息及存储文件，并支持批量删除；删除后当CDN缓存过期，该路流会无法播放，请谨慎操作
     * @param $client
     * @param $videoId
     * @param $jobIds
     * @return mixed
     */
    function delete_stream($client, $videoId, $jobIds) {
        $request = new vod\DeleteStreamRequest();
        $request->setVideoId($videoId);
        $request->setJobIds($jobIds);   // 媒体流转码的作业ID列表，多个用逗号分隔；JobId可通过获取播放地址接口(GetPlayInfo)获取到。
        $request->setAcceptFormat('JSON');
        return $client->getAcsResponse($request);
    }
}