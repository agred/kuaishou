<?php

namespace KuaiShou;

use KuaiShou\Kernel\BaseApi;

/**
 * 数据开放服务
 * Class Data
 * @package KuaiShou
 */
class Data extends BaseApi
{
    /**
     * @title 内容接口 - 获取定向配置
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=81
     * @param string $access_token
     */
    public function fanstop_photo_config_orientation($access_token)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/config/orientation';
        $params  = [
            'access_token' => $access_token
        ];
        return $this->https_post($api_url, $params);
    }

    /**
     * @title 内容接口 - 查询相似粉丝定向行业和达人
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=82
     * @param string $access_token
     */
    public function fanstop_photo_config_targetIndustry($access_token)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/config/targetIndustry';
        $params  = [
            'access_token' => $access_token
        ];
        return $this->https_post($api_url, $params);
    }

    /**
     * @title 内容接口 - 模糊搜索相似粉丝达人 (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=83
     * @param string $access_token
     * @param string $keyword
     */
    public function fanstop_photo_config_influencer($access_token, $keyword)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/config/influencer';
        $params  = [
            'access_token' => $access_token,
            'keyword'      => $keyword
        ];
        return $this->https_post($api_url, $params);
    }

    /**
     * @title 内容接口 - 获取用户与行业的dmpId (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=84
     * @param string $access_token
     * @param string $openId
     * @param string $industryId
     */
    public function fanstop_photo_config_dmp($access_token, $openId, $industryId)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/config/dmp';
        $params  = [
            'access_token' => $access_token,
            'openId'       => $openId,
            'industryId'   => $industryId
        ];
        return $this->https_post($api_url, $params);
    }

    /**
     * @title 内容接口 - 获取钱包配置 (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=85
     * @param string $access_token
     */
    public function fanstop_photo_balance_account($access_token)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/balanceAccount';
        $params  = [
            'access_token' => $access_token
        ];
        return $this->https_get($api_url, $params);
    }

    /**
     * @title 内容接口 - 获取推荐价格列表（入门版） (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=86
     * @param string $access_token
     */
    public function fanstop_photo_price_list($access_token)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/priceList';
        $params  = [
            'access_token' => $access_token
        ];
        return $this->https_get($api_url, $params);
    }

    /**
     * @title 内容接口 - 根据价格获取购量（入门版） (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=87
     * @param string $access_token
     * @param array $body
     */
    public function fanstop_photo_show_by_cost($access_token, $body)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/showByCost';
        $params  = [
            'access_token' => $access_token
        ];
        return $this->https_post($api_url, $params, $body);
    }

    /**
     * @title 内容接口 - 获取期望提升 (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=88
     * @param string $access_token
     * @param string $photoIds
     */
    public function fanstop_photo_spread_intention($access_token, $photoIds)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/spreadIntention';
        $params  = [
            'access_token' => $access_token,
            'photoIds'     => $photoIds
        ];
        return $this->https_get($api_url, $params);
    }

    /**
     * @title 内容接口 - 获取推荐出价与价格区间（出价版） (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=89
     * @param string $access_token
     * @param int $spreadIntention
     */
    public function fanstop_photo_heat_price_option($access_token, $spreadIntention)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/heatPriceOption';
        $params  = [
            'access_token'    => $access_token,
            'spreadIntention' => $spreadIntention
        ];
        return $this->https_get($api_url, $params);
    }

    /**
     * @title 内容接口 - 不出价版创建订单 (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=90
     * @param string $access_token
     * @param array $body
     */
    public function fanstop_photo_order_create_junior($access_token, $body)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/order/create/junior';
        $params  = [
            'access_token' => $access_token
        ];
        return $this->https_post($api_url, $params, $body);
    }

    /**
     * @title 内容接口 - 出价版创建订单 (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=91
     * @param string $access_token
     * @param array $body
     */
    public function fanstop_photo_order_create_senior($access_token, $body)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/order/create/senior';
        $params  = [
            'access_token' => $access_token
        ];
        return $this->https_post($api_url, $params, $body);
    }

    /**
     * @title 内容接口 - 关闭订单 (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=92
     * @param string $access_token
     * @param string $ksOrderId
     */
    public function fanstop_photo_order_close($access_token, $ksOrderId)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/order/close';
        $params  = [
            'access_token' => $access_token,
            'ksOrderId'    => $ksOrderId
        ];
        return $this->https_post($api_url, $params);
    }

    /**
     * @title 内容接口 - 查询订单效果 (需联系商务开通)
     * @Scope user_fanstop_photo
     * @url https://open.kuaishou.com/platform/openApi?group=GROUP_OPEN_PLATFORM&menu=93
     * @param string $access_token
     * @param string $ksOrderIds
     */
    public function fanstop_photo_order_stat($access_token, $ksOrderIds)
    {
        $api_url = self::API_KS . '/openapi/fanstop/photo/order/stat';
        $params  = [
            'access_token' => $access_token,
            'ksOrderIds'   => $ksOrderIds
        ];
        return $this->https_get($api_url, $params);
    }
}
