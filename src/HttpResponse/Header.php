<?php


class Header
{
    public function RequestHeader()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Access-Control-Max-Age: 3600");
    }
}