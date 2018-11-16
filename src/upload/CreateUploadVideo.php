<?php

namespace Zach\Aliyun\upload;

require_once '../aliyun-php-sdk/aliyun-php-sdk-core/Config.php';

use vod\Request\V20170321 as vod;

class CreateUploadVideo
{
    /**
     * 获取视频上传地址和凭证
     * @param $client
     * @param $title
     * @param $fileName
     * @param $description
     * @param $coverUrl
     * @param $tags
     * @return mixed
     */
    function create_upload_video($client, $title, $fileName, $description, $coverUrl, $tags) {
        $request = new vod\CreateUploadVideoRequest();
        $request->setTitle($title);        // 视频标题(必填参数)
        $request->setFileName($fileName); // 视频源文件名称，必须包含扩展名(必填参数)
        $request->setDescription($description);  // 视频源文件描述(可选)
        $request->setCoverURL($coverUrl); // 自定义视频封面(可选)
        $request->setTags($tags); // 视频标签，多个用逗号分隔(可选)
        $request->setAcceptFormat('JSON');


//        $request->setTitle("视频标题");        // 视频标题(必填参数)
//        $request->setFileName("文件名称.mov"); // 视频源文件名称，必须包含扩展名(必填参数)
//        $request->setDescription("视频描述");  // 视频源文件描述(可选)
//        $request->setCoverURL("http://img.alicdn.com/tps/TB1qnJ1PVXXXXXCXXXXXXXXXXXX-700-700.png"); // 自定义视频封面(可选)
//        $request->setTags("标签1,标签2"); // 视频标签，多个用逗号分隔(可选)
//        $request->setAcceptFormat('JSON');

        return $client->getAcsResponse($request);
    }
}