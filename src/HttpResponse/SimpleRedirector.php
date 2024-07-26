<?php

namespace TuringFrame;

class SimpleRedirector
{
    public function __construct($redirectLink)
    {
        if (!headers_sent()) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST');
            header('Access-Control-Allow-Headers: X-Requested-With');
            header('Content-Type: application/json');
            header("Location: $redirectLink");
        }
        exit;
    }
}
