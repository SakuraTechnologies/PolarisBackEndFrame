<?php

class ExceptionProcessor
{

    /** @var Exception */
    private $CLI_Exception;

    private $initJsonConfig;

    private $data;

    public function __construct($Yourdata, $YourKeyValue)
    {
        $date = date("Y-m-d_H-i-s");
        $this->CLI_Exception = "../log/Exception_" . $date . ".log";

        $logDirectory = dirname($this->CLI_Exception);
        if (!file_exists($logDirectory)) {
            mkdir($logDirectory, 0777, true);
        }
        file_put_contents($this->CLI_Exception, "$Yourdata");
        if (!chmod($this->CLI_Exception, 0777)) {
            echo "Error setting permissions on file: " . $this->CLI_Exception;
        }
        $this->initAdvancedConfig($YourKeyValue);

    }

    public function initAdvancedConfig($keyvalue)
    {
        $this->initJsonConfig = file_get_contents('exception_message.json');
        $this->data = json_decode($this->initJsonConfig, true);
        $data = $this->data["$keyvalue"];
        return $data;
    }

}