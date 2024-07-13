<?php

namespace HttpResponse;

require_once "SetHttpResponse.php";

// Get Http Response Code
class GetHttpReponseCode
{

    public function getHttpReponseCode($YourWebsiteIP, $SendCount = 1, $TimeOut = 1000)
    {
        // Get Server OS
        // 添加CORS HEADER
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: X-Requested-With');
        header('Content-Type: application/json');

        $ServerOS = PHP_OS;
        if (stripos($ServerOS, 'linux') !== false){
            $output = shell_exec("ping -c $SendCount -W $TimeOut $YourWebsiteIP");
        } elseif (stripos($ServerOS, 'win') !== false){
            $output = shell_exec("ping -n $SendCount -w $TimeOut $YourWebsiteIP");
        }
        // Check Packet Status
        if (strpos($output, '1 packets transmitted, 1 received') !== false ||
            strpos($output, '1 packets transmitted, 1 received') !== false) {
            $HttpResponsesCode = new SetHttpResponse();
            $HttpResponsesCode->SetHttpResponse(200);
            return 200;
        } else {
            $HttpResponsesCode = new SetHttpResponse();
            $HttpResponsesCode->SetHttpResponse(503);
            return 503;
        }
    }
}