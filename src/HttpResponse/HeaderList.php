<?php


namespace HttpResponse;


class HeaderList
{
    public function RequestHeader()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: X-Requested-With');
        header('Content-Type: application/json');
    }
}