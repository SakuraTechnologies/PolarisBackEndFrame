<?php

namespace HttpResponse;

class Redirect
{
    public function Redirect($RedirectLink)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: X-Requested-With');
        header('Content-Type: application/json');
        header("Location: $RedirectLink");
        exit;
    }
}