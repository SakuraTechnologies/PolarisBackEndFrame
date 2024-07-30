<?php

// Set Your Http Response Code
// This is A API
class SetHttpResponse
{
    private $code;

    public function __construct($code)
    {
        $this->code = $code;
        http_response_code($this->code);
        return $this->code;
    }
}