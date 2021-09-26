<?php

namespace KuaiShou;

use KuaiShou\Kernel\BaseApi;

/**
 * 视频管理
 * Class Video
 * @package KuaiShou
 */
class Video extends BaseApi
{

    /**
     * @title 查询指定视频数据
     * @Scope user_video_info
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=22
     * @param string $access_token
     * @param string $app_id
     * @param mixed $photo_id
     */
    public function video_data($access_token, $app_id, $photo_id)
    {
        $api_url = self::KUAISHOU_API . '/openapi/photo/info/';
        $params = [
            'access_token' => $access_token,
            'app_id' => $app_id,
            'photo_id' => $photo_id
        ];
        return $this->https_get($api_url , $params);
    }

    /**
     * @title 查询授权账号视频数据
     * @Scope user_video_info
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=22
     * @param string $access_token
     * @param string $app_id
     * @param int $cursor 分页游标, 第一页请求cursor是0
     * @param int $count 每页数量
     */
    public function video_list($access_token, $app_id, $cursor = 0, $count = 20)
    {
        $api_url = self::KUAISHOU_API . '/openapi/photo/list/';
        $params = [
            'access_token' => $access_token,
            'app_id' => $app_id,
            'cursor' => $cursor,
            'count' => $count
        ];
        return $this->https_get($api_url, $params);
    }

    /**
     * @title 查询视频数量接口
     * @Scope user_video_info
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=22
     * @param string $access_token
     * @param string $app_id
     */
    public function video_count($access_token, $app_id)
    {
        $api_url = self::KUAISHOU_API . '/openapi/photo/count/';
        $params = [
            'access_token' => $access_token,
            'app_id' => $app_id
        ];
        return $this->https_get($api_url , $params);
    }

    /**
     * @title 创建视频 - 发起上传
     * @Scope user_video_publish
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $access_token
     * @param string $app_id
     */
    public function video_start_upload($access_token, $app_id)
    {
        $api_url = self::KUAISHOU_API . '/openapi/photo/start_upload/';
        $params = [
            'access_token' => $access_token,
            'app_id' => $app_id
        ];
        $api_url = $api_url . '?' . http_build_query($params);
        return $this->https_post($api_url);
    }


    /**
     * @title 创建视频 - 上传视频 - 二进制
     * @Scope user_video_publish
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $endpoint 上传网关的域名
     * @param string $upload_token 上传令牌
     * @param string $file 上传文件
     */
    public function video_upload_binary($endpoint, $upload_token, $file)
    {
        $api_url = 'http://'.$endpoint . '/api/upload/?upload_token=' . $upload_token;
        return $this->https_byte($api_url, $file);
    }

    /**
     * @title 创建快手视频
     * @Scope video.create
     * @url https://open.kuaishou.com/platform/doc/6848798087398328323
     * @param string $open_id
     * @param string $access_token
     * @param array $dataBody
     */
    public function video_create($open_id, $access_token, $dataBody = [])
    {
        $api_url = self::KUAISHOU_API . '/video/create/';
        $params = [
            'open_id' => $open_id,
            'access_token' => $access_token
        ];
        $api_url = $api_url . '?' . http_build_query($params);
        return $this->https_post($api_url , $dataBody);
    }

    /**
     * @title 删除视频
     * @Scope video.delete
     * @url https://open.kuaishou.com/platform/doc/6848806536383383560
     * @param string $open_id
     * @param string $access_token
     * @param string $item_id
     */
    public function video_delete($open_id, $access_token, $item_id)
    {
        $api_url = self::KUAISHOU_API . '/video/delete/';
        $params = [
            'open_id' => $open_id,
            'access_token' => $access_token
        ];
        $api_url = $api_url . '?' . http_build_query($params);
        return $this->https_post($api_url , $item_id);
    }

    /**
     * @title 初始化分片上传
     * @Scope video.create
     * @url https://open.kuaishou.com/platform/doc/6848798087398393859
     * @param string $open_id
     * @param string $access_token
     */
    public function video_part_init($open_id, $access_token)
    {
        $api_url = self::KUAISHOU_API . '/video/part/init/';
        $params = [
            'open_id' => $open_id,
            'access_token' => $access_token
        ];
        $api_url = $api_url . '?' . http_build_query($params);
        return $this->https_post($api_url);
    }

    /**
     * @title 上传视频分片到文件服务器
     * @Scope video.create
     * @url https://open.kuaishou.com/platform/doc/6848798087226460172
     * @param string $open_id
     * @param string $access_token
     * @param string $upload_id
     * @param string $part_number
     * @param array $video
     */
    public function video_part_upload($open_id, $access_token, $upload_id, $part_number, $video = [])
    {
        $api_url = self::KUAISHOU_API . '/video/part/upload/';
        $params = [
            'open_id' => $open_id,
            'access_token' => $access_token,
            'upload_id' => $upload_id,
            'part_number' => $part_number,
        ];
        $api_url = $api_url . '?' . http_build_query($params);
        return $this->https_post($api_url, $video);
    }

    /**
     * @title 分片完成上传
     * @Scope video.create
     * @url https://open.kuaishou.com/platform/doc/6848798087398361091
     * @param string $open_id
     * @param string $access_token
     * @param string $upload_id
     */
    public function video_part_complete($open_id, $access_token, $upload_id)
    {
        $api_url = self::KUAISHOU_API . '/video/part/complete/';
        $params = [
            'open_id' => $open_id,
            'access_token' => $access_token,
            'upload_id' => $upload_id
        ];
        $api_url = $api_url . '?' . http_build_query($params);
        return $this->https_post($api_url);
    }

    /**
     * @title 获取share-id
     * @Scope aweme.share
     * @url https://open.kuaishou.com/platform/doc/6848798622172121099
     * @param string $access_token
     * @param bool $need_callback
     */
    public function share_id($access_token, $need_callback = true)
    {
        $api_url = self::KUAISHOU_API . '/share-id/';
        $params = [
            'access_token' => $access_token,
            'need_callback' => $need_callback,
            'default_hashtag' => 'hashtag'
        ];
        return $this->https_get($api_url, $params);
    }

}
