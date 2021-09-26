<?php

use KuaiShou\Kernel\DataArray;

/**
 * Class Ks
 * @package KuaiShou
 *
 * @method \KuaiShou\Oauth Oauth($options = []) static 扫码授权
 * @method \KuaiShou\Poi Poi($options = []) static 商铺接入
 * @method \KuaiShou\User User($options = []) static 用户操作
 * @method \KuaiShou\Video Video($options = []) static 视频操作
 * @method \KuaiShou\Comment Comment($options = []) static 用户评论
 * @method \KuaiShou\Toutiao Toutiao($options = []) static 头条操作
 * @method \KuaiShou\Tool Tool($options = []) static 工具能力
 * @method \KuaiShou\Data Data($options = []) static 数据开放服务
 * @method \KuaiShou\Search Search($options = []) static 搜索管理
 * @method \KuaiShou\Event Event($options = []) static Webhooks事件订阅
 * @method \KuaiShou\Othe Othe($options = []) static 其它操作
 */
class Ks
{

    /**
     * 静态配置
     */
    private static $config;

    /**
     * 设置及获取参数
     * @param array $option
     * @return array
     */
    public static function config($option = null)
    {
        if (is_array($option)) {
            self::$config = new DataArray($option);
        }
        if (self::$config instanceof DataArray) {
            return self::$config->get();
        }
        return [];
    }

    /**
     * 静态魔术加载方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name , $arguments)
    {
        $name = ucfirst(strtolower($name));
        $class = "\\KuaiShou\\{$name}";

        if (!empty($class) && class_exists($class)) {
            $option = array_shift($arguments);
            $config = is_array($option) ? $option : self::$config->get();
            return new $class($config);
        }
    }

}
