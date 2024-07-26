<?php

namespace HttpResponse;

// Set Your Http Response Code
// This is A API
class SetHttpResponse
{
    public function __construct($YourHttpResponseCode)
    {
        http_response_code($YourHttpResponseCode);
    }
}