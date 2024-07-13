<?php

namespace HttpResponse;

// Send GET Packet
class SendGet
{
    public function GetSender($url)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: X-Requested-With');
        header('Content-Type: application/json');
        // Init Cur;
        $ch = curl_init();
        // Set Curl Option
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Exec Curl Talk
        $response = curl_exec($ch);
        // Except err
        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            $result = json_decode($response, true);
            print_r($result);
        }
        curl_close($ch);
    }
}