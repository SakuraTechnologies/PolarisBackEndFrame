<?php

require_once 'Header.php';

class SimpleRedirector
{
    public function __construct($redirectLink)
    {
        if (!headers_sent()) {
            $header = new Header();
            $header->RequestHeader();
            header("Location: $redirectLink");
        }
        exit;
    }
}
