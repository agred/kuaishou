<?php

namespace KuaiShou;

use KuaiShou\Kernel\BaseApi;

/**
 * 账号授权
 * Class Oauth
 * @package KuaiShou
 */
class Oauth extends BaseApi
{

    /**
     * @title 获取授权码(网页登陆后授权模式) 目前网页应用提供三种授权方式,分别为 网页登陆后授权模式 和 手机扫码授权模式
     * @Scope
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=12
     * @param array $scope 多个scope可以使用","分割 user_info,user_video_publish,user_video_info
     * @param string $redirect_uri 必须以http/https开头
     * @param string $state
     * @param string $ua
     */
    public function authorize($scope, $redirect_uri, $state = "", $ua = "")
    {
        $api_url = self::OPEN_API . '/oauth2/authorize/';
        $params = [
            'response_type' => 'code',
            'scope' => implode(',', $scope),
            'redirect_uri' => $redirect_uri
        ];
        if ($state) {
            $params['state'] = $state;
        }
        if ($ua) {
            $params['ua'] = $ua;
        }
        return $api_url . '?' . http_build_query($params);
    }

    /**
     * @title 获取access_token
     * @Scope
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=13
     * @param string $code
     */
    public function access_token($code)
    {
        $api_url = self::OPEN_API . '/oauth2/access_token/';
        $params = [
            'code' => $code,
            'grant_type' => 'authorization_code'
        ];
        return $this->https_get($api_url, $params);
    }

    /**
     * @title 刷新refresh_token
     * @Scope refreshAccessToken
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=13
     * @param string $refresh_token 通过access_token获取到的refresh_token参数
     */
    public function renew_refresh_token($refresh_token)
    {
        $api_url = self::OPEN_API . '/oauth2/refresh_token/';
        $params = [
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token'
        ];
        return $this->https_get($api_url, $params);
    }

}
