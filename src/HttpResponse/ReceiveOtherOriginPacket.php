<?php


require_once '../ExceptionProcessor.php';
require_once 'SetHttpResponse.php';
require_once 'Header.php';

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
        $header = new Header();
        $header->RequestHeader();
        try {
            if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
                // 预检请求，直接返回成功响应
                $httpResponse = new SetHttpResponse(200);
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
        } catch (Exception $e) {
            $date = date("Y-m-d_H-i-s");
            new ExceptionProcessor($e->getMessage() . "$e\n", "ReceiveOtherOriginPacket Err was happend!\n" . "turingframe.exception.cli\n" . "YukinaNetwork & BannerServer Tech Team ©2024\n" . "$date");
        }
    }

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
        $header = new Header();
        $header->RequestHeader();

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

