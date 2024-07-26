<?php

namespace HttpResponse;

require_once "SetHttpResponse.php";
require_once 'HeaderList.php';

// Get Http Response Code
class GetHttpReponseCode
{
    /** @var void */
    private $Header;

    public function __construct()
    {
        $this->Header = new HeaderList();
    }

    public function getHttpReponseCode($YourWebsiteIP, $SendCount = 1, $TimeOut = 1000)
    {
        $this->Header->RequestHeader();
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

