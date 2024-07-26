<?php

namespace HttpResponse;

require_once 'SetHttpResponse.php';
require_once 'HeaderList.php';

class ReceiveOtherOriginPacket
{

    /**
     * 接受POST数据包，并使用提供的函数处理数据
     *
     * @param callable $dataHandler 用于处理数据的回调函数
     */
    public function receiveOtherOriginPostPacket(callable $dataHandler, $Message)
    {
        // Add Cors Header
        $HeaderList = new HeaderList();
        $HeaderList->RequestHeader();

        if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
            // 预检请求，直接返回成功响应
            new SetHttpResponse(200);
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = $this->getRequestBody();

            // 使用提供的函数处理数据
            $processedData = $dataHandler($data);

            // 构造响应
            $response = [
                'status' => 'success',
                'message' => "$Message",
                'data' => $processedData
            ];

            echo json_encode($response);
        }
    }

    // Add Cores Request Header


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
        $HeaderList = new HeaderList();
        $HeaderList->RequestHeader();

        if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
            // 预检请求，直接返回成功响应
            new SetHttpResponse(200);
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

