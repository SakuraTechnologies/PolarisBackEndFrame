<?php

namespace TuringFrame;

class ImproveCommand
{

    public function onCommand()
    {
        echo "TMS (Turing Terminal Service) was started, enter 'help' to get more " . "\n";
        $this->fileServerStart();
        while (true) {
            $result = trim(fgets(STDIN));
            switch ($result){
                case 'exit':
                    exit;
                case 'help':
                    echo '--Help List--' . "\n";
                    echo 'Enter Tpm [Serveraddr] to get Other package' . "\n";
                    echo 'Enter exit to exit' . "\n";
                    break;
                case 'Tpm':
                    echo 'Enter Tpm ServerAddr' . "\n";
                    $Addr = trim(fgets(STDIN));
                    echo 'Enter You need Package Name(must with .phar or other file extension)';
                    $FileName = trim(fgets(STDIN));
                    $this->TPM($Addr, $FileName);
                    break;
                default:
                    echo 'Command not found' . "\n";
            }
        }
    }

    // TuringPackageManager
    public function TPM($Addr, $FileName){
        $url = "$Addr";
        $local_file = "\TuringFrame\src\outlib/$FileName";
        $remote_file = fopen($url, 'r');
        $fp = fopen($local_file, 'w');
        while (!feof($remote_file)) {
            fwrite($fp, fread($remote_file, 1024));
        }
        fclose($remote_file);
        fclose($fp);
    }

    public function fileServerStart(){
        $openFile = file_get_contents('\TuringFrame\config.json');
        $data = json_decode($openFile, true);
        if ($data['Development'] = true){
            echo "File Service was Started";
        } else {
            echo "SB";
        }
    }


}

$obj = new ImproveCommand();
$obj->onCommand();