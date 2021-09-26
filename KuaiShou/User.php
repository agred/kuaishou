<?php

namespace KuaiShou;

use KuaiShou\Kernel\BaseApi;

/**
 * 用户管理
 * Class User
 * @package KuaiShou
 */
class User extends BaseApi
{

    /**
     * @title 获取用户信息
     * @Scope user_info
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=17
     * @param string $app_id
     * @param string $access_token
     */
    public function userinfo($app_id, $access_token)
    {
        $api_url = self::KUAISHOU_API . '/openapi/user_info/';
        $params = [
            'app_id' => $app_id,
            'access_token' => $access_token
        ];
        return $this->https_get($api_url, $params);
    }

    /**
     * @title 获取手机号
     * @Scope user_phone
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=18
     * @param string $app_id
     * @param string $access_token
     */
    public function userphone($app_id, $access_token)
    {
        $api_url = self::KUAISHOU_API . '/openapi/user_phone/';
        $params = [
            'app_id' => $app_id,
            'access_token' => $access_token
        ];
        $iv = substr($this->app_secret, 0, 16);
        if($response = $this->https_get($api_url, $params)) {
            $encrypted_phone = $response['encrypted_phone'];
            return openssl_decrypt($encrypted_phone, 'aes-256-cbc', $this->app_secret, 0, $iv);
        }
        return false;
    }

}
