<?php

require_once 'InitCURL.php';

class GetRemoteJson
{
    private $url;
    private $data;

    public function __construct($url)
    {
        $this->url = $url;
        $this->fetchData();
    }

    private function fetchData()
    {
        $initCurl = new InitCURL($this->url);
        $response = $initCurl->getResponse(); // 获取响应数据
        if ($response === false) {
            die('Error: Failed to fetch data from ' . $this->url);
        }
        $this->data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die('Error: Failed to decode JSON data');
        }
    }

    public function getData()
    {
        return $this->data;
    }
}