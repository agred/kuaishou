<?php

namespace KuaiShou;

use KuaiShou\Kernel\BaseApi;

/**
 * @title 获取URL某个参数的值
 * @param string $url 路径
 * @param string $key 要获取的参数
 * @return string
 */
function get_query_str($url, $key)
{
    $res = '';
    $a   = strpos($url, '?');
    if ($a !== false) {
        $str = substr($url, $a + 1);
        $arr = explode('&', $str);
        foreach ($arr as $k => $v) {
            $tmp = explode('=', $v);
            if (!empty($tmp[0]) && !empty($tmp[1])) {
                $barr[$tmp[0]] = $tmp[1];
            }
        }
    }
    if (!empty($barr[$key])) {
        $res = $barr[$key];
    }
    return $res;
}

/**
 * @title 是否快手客户端
 * @return bool
 */
if (!function_exists('is_kwai')) {
    function is_kwai()
    {
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'kwai') !== false) {
            return true;
        }
        return false;
    }
}

/**
 * @title 是否苹果iphone
 * @return bool
 */
if (!function_exists('is_iphone')) {
    function is_iphone()
    {
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone') !== false) {
            return true;
        }
        return false;
    }
}

/**
 * @title 获取快手URL Scheme
 * @param array $params 参数
 * @return string
 */
function get_url_scheme($params = [])
{
    switch ($params['type']) {
        case 'profile':
            $link = 'kwai://profile/' . $params['uid'] . '';
            break;
        default :
            $link = '';

    }
    return $link;
}
