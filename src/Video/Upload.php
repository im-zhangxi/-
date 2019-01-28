<?php

namespace Zach\Aliyun\Video;

use vod\Request\V20170321 as vod;

class Upload extends Base
{
    /**
     * 获取视频上传地址和凭证
     * @param $client
     * @return mixed
     */
    function create_upload_video($client, $input) {
        $request = new vod\CreateUploadVideoRequest();
//        $request->setTitle("视频标题");        // 视频标题(必填参数)
//        $request->setFileName("文件名称.mov"); // 视频源文件名称，必须包含扩展名(必填参数)
//        $request->setDescription("视频描述");  // 视频源文件描述(可选)
//        $request->setCoverURL("http://img.alicdn.com/tps/TB1qnJ1PVXXXXXCXXXXXXXXXXXX-700-700.png"); // 自定义视频封面(可选)
//        $request->setTags("标签1,标签2"); // 视频标签，多个用逗号分隔(可选)

        $requiredList = [
            'title' => '视频标题',
            'file_name' => '文件名称.mov',
        ];
        $this->validateInput($input, $requiredList);

        $request->setTitle($input['title']);        // 视频标题(必填参数)
        $request->setFileName($input['file_name']); // 视频源文件名称，必须包含扩展名(必填参数)
        if (!empty($input['description'])) {
            $request->setDescription($input['description']);  // 视频源文件描述(可选)
        }

        if (!empty($input['cover_url'])) {
            $request->setCoverURL($input['cover_url']);  // 自定义视频封面(可选)
        }

        if (!empty($input['tags'])) {
            $request->setTags($input['tags']);  // 视频标签，多个用逗号分隔(可选)
        }

        if (!empty($input['cate_id'])) {
            $request->setCateId($input['cate_id']);  // 视频分类，多个用逗号分隔(可选)
        }

        $request->setAcceptFormat('JSON');


        return $client->getAcsResponse($request);
    }

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