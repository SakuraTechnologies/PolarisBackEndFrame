<?php

namespace HttpResponse;

require_once 'SetHttpResponse.php';
class ReceiveOtherOriginPacket
{
    /**
     * 接受POST数据包，并使用提供的函数处理数据
     *
     * @param callable $dataHandler 用于处理数据的回调函数
     */
    public function receiveOtherOriginPostPacket(callable $dataHandler)
    {
        // Add Cors Header
        $this->addCorsHeaders();

        if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
            // 预检请求，直接返回成功响应
            $httpResponse = new SetHttpResponse();
            $httpResponse->setHttpResponse(200);
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = $this->getRequestBody();

            // 使用提供的函数处理数据
            $processedData = $dataHandler($data);

            // 构造响应
            $response = [
                'status' => 'success',
                'message' => 'Data received and processed',
                'data' => $processedData
            ];

            echo json_encode($response);
        }
    }

    // Add Cores Request Header
    private function addCorsHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Access-Control-Max-Age: 3600");
    }

    // String A Request Body
    private function getRequestBody()
    {
        if ($_SERVER["CONTENT_TYPE"] === "application/json") {
            return json_decode(file_get_contents('php://input'), true);
        } else {
            return $_POST;
        }
    }

    /**
     * 接受GET数据包，并使用提供的函数处理数据
     *
     * @param callable $dataHandler 用于处理数据的回调函数
     */
    public function receiveOtherOriginGetPacket(callable $dataHandler)
    {
        // Add Cors Header
        $this->addCorsHeaders();

        if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
            // 预检请求，直接返回成功响应
            $httpResponse = new SetHttpResponse();
            $httpResponse->SetHttpResponse(200);
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $data = $_GET; // GET 请求的数据在 $_GET 超全局变量中

            // 使用提供的函数处理数据
            $processedData = $dataHandler($data);

            // 构造响应
            $response = [
                'status' => 'success',
                'data' => $processedData
            ];

            echo json_encode($response);
        }
    }
}

