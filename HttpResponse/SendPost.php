<?php

/**
 * This Project Powered by TINUOKAS1
 * CopyRight 2023-2024 YukinaNetwork
 * All Rights Reserved
 * This Project allowed GPL-V3 License
 * And our team is from China!
 */

namespace HttpResponse;

// Send Post Module
class SendPost
{
    // Main Module
    public function PostSender($ResponseData, $PostSendurl)
    {
        // Init curl
        $Curl = curl_init();
        // Set A Json Data
        $Data = json_encode(
            $ResponseData
        );

        // Set Curl Header
        curl_setopt($Curl, CURLOPT_URL, $PostSendurl);
        curl_setopt($Curl, CURLOPT_POST, true);
        curl_setopt($Curl, CURLOPT_POSTFIELDS, $Data);
        // Set Post Type
        curl_setopt($Curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($Data)]
        );
        curl_setopt($Curl, CURLOPT_RETURNTRANSFER, true);
        // exec curl talk
        $response = curl_exec($Curl);

        // if has error
        if (curl_errno($Curl)) {
            echo 'Error: ' . curl_error($Curl);
            // else send
        } else {
            $result = json_decode($response, true);
            print_r($result);
        }

        // then closed
        curl_close($Curl);
    }

}