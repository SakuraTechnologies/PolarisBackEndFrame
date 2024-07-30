<?php

require_once "SetHttpResponse.php";

// Get Http Response Code
class GetHttpReponseCode
{

    public function __construct($YourWebsiteIP, $SendCount = 1, $TimeOut = 1000)
    {
        // Get Server OS
        // 添加CORS HEADER
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: X-Requested-With');
        header('Content-Type: application/json');

        $ServerOS = PHP_OS;
        if (stripos($ServerOS, 'linux') !== false) {
            $output = shell_exec("ping -c $SendCount -W $TimeOut $YourWebsiteIP");
        } elseif (stripos($ServerOS, 'win') !== false) {
            $output = shell_exec("ping -n $SendCount -w $TimeOut $YourWebsiteIP");
        }
        // Check Packet Status
        if (str_contains($output, '1 packets transmitted, 1 received') ||
            str_contains($output, '1 packets transmitted, 1 received')) {
            new SetHttpResponse(200);
            return 200;
        } else {
            new SetHttpResponse(503);
            return 503;
        }
    }
}

