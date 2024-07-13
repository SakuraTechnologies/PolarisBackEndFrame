<?php

namespace DataBase;

interface SQLTypeInterface
{
    public function Mysql($host, $user, $password, $database);

    public function SQLite($db_file, $EncryptionKey);

    public function PostgreSQL($host, $user, $password, $database);

}