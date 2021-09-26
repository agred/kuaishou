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
     * @title 获取授权码(code) **该URL不是用来请求的, 需要展示给用户用于扫码，在快手APP支持端内唤醒的版本内打开的话会弹出客户端原生授权页面。
     * @Scope
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=12
     * @param array $scope 应用授权作用域['user_info']
     * @param string $redirect_uri 必须以http/https开头
     * @param string $state
     * @param string $optionalScope
     */
    public function connect($scope, $redirect_uri, $state = "", $optionalScope = "")
    {
        $api_url = self::KUAISHOU_API . '/openapi/user_info/';
        $params = [
            'response_type' => 'code',
            'scope' => implode(',', $scope),
            'redirect_uri' => $redirect_uri
        ];
        if ($state) {
            $params['state'] = $state;
        }
        if ($optionalScope) {
            $params['optionalScope'] = $optionalScope;
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
        $api_url = self::KUAISHOU_API . '/oauth2/access_token/';
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
        $api_url = self::KUAISHOU_API . '/oauth2/refresh_token/';
        $params = [
            'refresh_token' => $refresh_token,
            'grant_type' => 'refresh_token'
        ];
        return $this->https_get($api_url, $params);
    }

}
