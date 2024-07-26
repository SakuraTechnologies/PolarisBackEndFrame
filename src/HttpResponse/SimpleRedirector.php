<?php

namespace TuringFrame;

use HttpResponse\HeaderList;

require_once 'HeaderList.php';

class SimpleRedirector
{
    public function __construct($redirectLink)
    {
        if (!headers_sent()) {
            $Header = new HeaderList();
            $Header->RequestHeader();
            header("Location: $redirectLink");
        }
        exit;
    }
}
