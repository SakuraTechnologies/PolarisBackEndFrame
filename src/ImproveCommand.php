<?php

namespace TuringFrame;

use Exception;

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
    public function TPM($Addr, $FileName)
    {
        try {
            $url = "$Addr";

            $local_file = "./src/outlib/$FileName";
            $remote_file = fopen($url, 'r');
            $fp = fopen($local_file, 'w');
            while (!feof($remote_file)) {
                fwrite($fp, fread($remote_file, 1024));
            }
            fclose($remote_file);
            fclose($fp);
        } catch (Exception $e){
            echo $e->getMessage();
            return true;
        }
    }

    public function fileServerStart() {
        $openFile = file_get_contents('\TuringFrame\config.json');
        $data = json_decode($openFile, true);

        if ($data['Development'] === true) {
            $filePath = '\TuringFrame\prj-assets/ftp.excluded';

            if (!file_exists($filePath)) {
                @mkdir("../prj-assets", 0777);
                @chmod("../prj-assets/ftp.php", 0777);
                $data1 = fopen("../src/ftpserver/ftp.php", 'r');
                file_put_contents("../prj-assets/ftp.php", $data1);
                $dirPath = dirname($filePath);
                if (!is_dir($dirPath)) {
                    mkdir($dirPath, 0777, true);
                }
                touch($filePath);
                chmod($filePath, 0644);
                exec("php ../prj-assets/ftp.php");
            }
            echo "Develop Service was started!". "\n";
        } else {
            echo "Develop Server Failed to Create ". "\n";
        }

        if (file_exists($filePath)){
            echo "Server was created" ;
            return;
        }
    }


}

$obj = new ImproveCommand();
$obj->onCommand();