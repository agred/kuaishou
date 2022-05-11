<?php

namespace KuaiShou\Kernel;

/**
 * 内核
 * Class BaseApi
 * @package KuaiShou\Kuaishou\Kernel
 */
class BaseApi
{
    const SDK_VER = '1.0.8';

    const OPEN_API  = "https://open.kuaishou.com";
    public $app_id    = null;
    public $app_secret = null;

    public $response = null;

    public function __construct($config)
    {
        $this->app_id = $config['app_id'];
        $this->app_secret = $config['app_secret'];
    }

    public function toArray()
    {
        return $this->response ? json_decode($this->response, true) : true;
    }

    public function https_curl($url, $data = [])
    {
        $data['app_id'] = $this->app_id;
        $data['app_secret'] = $this->app_secret;
        if($data){
            $url = $url . '?' . http_build_query($data);
        }
        $result = $this->https_request($url, $data);
        if (is_null(json_decode($result))) {
            return $result;
        } else {
            return json_decode($result, true);
        }
    }

    public function https_code($url , $params = []){
        $params['app_id'] = $this->app_id;
        $params['app_secret'] = $this->app_secret;
        if($params){
            $url = $url . '?' . http_build_query($params);
        }
        return $this->https_request($url);
    }

    public function https_get($url , $params = []){
        $params['app_id'] = $this->app_id;
        $params['app_secret'] = $this->app_secret;
        if($params){
            $url = $url . '?' . http_build_query($params);
        }
        $result = $this->https_request($url);
        if (is_null(json_decode($result))) {
            return $result;
        } else {
            return json_decode($result, true);
        }
    }

    public function https_post($url, $params = [], $data = [], $header = true){
        $header = $header ? ['Accept:application/json' , 'Content-Type:application/json'] : [];
        $params['app_id'] = $this->app_id;
        $params['app_secret'] = $this->app_secret;
        if($params){
            $url = $url . '?' . http_build_query($params);
        }
        $result = $this->https_request($url, json_encode($data), $header);
        if (is_null(json_decode($result))) {
            return $result;
        } else {
            return json_decode($result, true);
        }
    }

    public function https_file($url, $params = [], $data = [], $header = true){
        $header = $header ? ['Accept:application/json' , 'Content-Type:multipart/form-data'] : [];
        $params['app_id'] = $this->app_id;
        $params['app_secret'] = $this->app_secret;
        if($params){
            $url = $url . '?' . http_build_query($params);
        }
        $result = $this->https_request($url, $data, $header);
        if (is_null(json_decode($result))) {
            return $result;
        } else {
            return json_decode($result, true);
        }
    }

    public function https_request($url, $data = null, $headers = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        if (!empty($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
            curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }
        $output = curl_exec($curl);
        curl_close($curl);
        return ($output);
    }

    public function https_byte($url, $file)
    {
        $payload = '';
        $params = "--__X_PAW_BOUNDARY__\r\n"
            . "Content-Type: application/x-www-form-urlencoded\r\n"
            . "\r\n"
            . $payload . "\r\n"
            . "--__X_PAW_BOUNDARY__\r\n"
            . "Content-Type: video/mp4\r\n"
            . "Content-Disposition: form-data; name=\"file\"; filename=\"test.mp4\"\r\n"
            . "\r\n"
            . file_get_contents($file) . "\r\n"
            . "--__X_PAW_BOUNDARY__--";

        $first_newline = strpos($params, "\r\n");
        $multipart_boundary = substr($params, 2, $first_newline - 2);
        $request_headers = array();
        $request_headers[] = 'Content-Length: ' . strlen($params);
        $request_headers[] = 'Content-Type: multipart/form-data; boundary=' . $multipart_boundary;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
            curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output, true);
    }

}
