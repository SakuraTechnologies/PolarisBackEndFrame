<?php

function FtpCreate(){

    $openfile = fopen("../config.json", "r");

    $jsonContent = fread($openfile, filesize("../config.json"));
    fclose($openfile);
    $port2 = json_decode($jsonContent, true);
    $port = $port2['ftpport'];
    $address = '127.0.0.1';


    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket === false) {
        echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
        exit;
    }

    $result = socket_bind($socket, $address, $port);
    if ($result === false) {
        echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
        exit;
    }

    $result = socket_listen($socket, 5);
    if ($result === false) {
        echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
        exit;
    }

    echo "Listening on $address:$port\n";

    while (true) {
        $client_socket = socket_accept($socket);
        if ($client_socket === false) {
            echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
            continue;
        }

        $data = socket_read($client_socket, 1024);
        echo "Received: $data\n";

        $response = "220 Welcome to the FTP server.\r\n";
        $result = socket_write($client_socket, $response, strlen($response));
        if ($result === false) {
            echo "socket_write() failed: reason: " . socket_strerror(socket_last_error($socket)) . "\n";
        }

        // 关闭连接
        socket_close($client_socket);

        socket_close($socket);
    }


}

FtpCreate();