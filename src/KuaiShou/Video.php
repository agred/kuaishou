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
     * @title 查询授权账号视频数据
     * @Scope user_video_info
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=22
     * @param string $access_token
     * @param int $cursor 分页游标, 第一页请求cursor是0
     * @param int $count 每页数量
     */
    public function video_list($access_token, $cursor = 0, $count = 20)
    {
        $api_url = self::OPEN_API . '/openapi/photo/list';
        $params = [
            'access_token' => $access_token,
            'cursor' => $cursor,
            'count' => $count
        ];
        return $this->https_get($api_url, $params);
    }

    /**
     * @title 查询指定视频数据
     * @Scope user_video_info
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=22
     * @param string $access_token
     * @param mixed $photo_id
     */
    public function video_info($access_token, $photo_id)
    {
        $api_url = self::OPEN_API . '/openapi/photo/info';
        $params = [
            'access_token' => $access_token,
            'photo_id' => $photo_id
        ];
        return $this->https_get($api_url , $params);
    }

    /**
     * @title 查询视频数量接口
     * @Scope user_video_info
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=22
     * @param string $access_token
     */
    public function video_count($access_token)
    {
        $api_url = self::OPEN_API . '/openapi/photo/count';
        $params = [
            'access_token' => $access_token
        ];
        return $this->https_get($api_url , $params);
    }

    /**
     * @title 创建视频 - 发起上传
     * @Scope user_video_publish
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $access_token
     */
    public function video_start_upload($access_token)
    {
        $api_url = self::OPEN_API . '/openapi/photo/start_upload';
        $params = [
            'access_token' => $access_token
        ];
        return $this->https_post($api_url, $params);
    }


    /**
     * @title 创建视频 - 上传视频 - 二进制上传
     * @Scope user_video_publish
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $endpoint 上传网关的域名
     * @param string $upload_token 上传令牌
     * @param string $file 上传文件
     */
    public function video_upload_binary($endpoint, $upload_token, $file)
    {
        $api_url = 'http://'.$endpoint . '/api/upload?upload_token=' . $upload_token;
        return $this->https_byte($api_url, $file);
    }

    /**
     * @title 创建视频 - 上传视频 - Multipart Form Data上传
     * @Scope user_video_publish
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $endpoint 上传网关的域名
     * @param string $upload_token 上传令牌
     * @param string $file 上传文件
     */
    public function video_upload_multipart($endpoint, $upload_token, $file)
    {
        $api_url = 'http://'.$endpoint . '/api/upload/multipart?upload_token=' . $upload_token;
        return $this->https_byte($api_url, $file);
    }

    /**
     * @title 创建视频 - 分片上传 - 上传分片
     * @Scope user_video_publish
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $endpoint 上传网关的域名
     * @param string $upload_token 上传令牌
     * @param string $fragment_id 分片id 从0开始
     */
    public function video_upload_fragment($endpoint, $upload_token, $fragment_id)
    {
        $api_url = 'http://'.$endpoint . '/api/upload/fragment?upload_token=' . $upload_token;
        return $this->https_byte($api_url, $fragment_id);
    }

    /**
     * @title 创建视频 - 分片上传 - 断点续传
     * @Scope user_video_publish
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $endpoint 上传网关的域名
     * @param string $upload_token 上传令牌
     * @param string $fragment_id 分片id 从0开始
     */
    public function video_upload_resume($endpoint, $upload_token, $fragment_id)
    {
        $api_url = 'http://'.$endpoint . '/api/upload/resume?upload_token=' . $upload_token;
        return $this->https_byte($api_url, $fragment_id);
    }

    /**
     * @title 创建视频 - 分片上传 - 完成分片上传
     * @Scope user_video_publish
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $endpoint 上传网关的域名
     * @param string $upload_token 上传令牌
     * @param string $fragment_id 分片id 从0开始
     */
    public function video_upload_complete($endpoint, $upload_token, $fragment_count )
    {
        $api_url = 'http://'.$endpoint . '/api/upload/complete?upload_token=' . $upload_token;
        return $this->https_post($api_url, $fragment_count);
    }

    /**
     * @title 发布视频
     * @Scope user_video_publish
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $access_token 授权token
     * @param string $upload_token 上传令牌
     * @param array $body body参数
     */
    public function video_upload_publish($access_token, $upload_token, $body = [])
    {
        $api_url = self::OPEN_API . '/openapi/photo/publish';
        $params = [
            'access_token' => $access_token,
            'upload_token' => $upload_token,
        ];
        return $this->https_file($api_url, $params, $body);
    }


    /**
     * @title 删除视频
     * @Scope user_video_delete
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=20
     * @param string $access_token
     * @param string $photo_id
     */
    public function video_delete($access_token, $photo_id)
    {
        $api_url = self::OPEN_API . '/openapi/photo/delete';
        $params = [
            'access_token' => $access_token,
            'photo_id' => $photo_id
        ];
        return $this->https_post($api_url , $params);
    }

}
