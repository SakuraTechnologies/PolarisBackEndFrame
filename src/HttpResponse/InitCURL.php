<?php

class InitCURL
{
    private $response;

    public function __construct($url)
    {
        $this->response = $this->fetchData($url);
    }

    private function fetchData($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 将 cURL 的结果作为字符串返回
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}