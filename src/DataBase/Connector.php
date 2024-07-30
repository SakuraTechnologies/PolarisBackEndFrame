<?php

namespace DataBase;

use mysqli;
use PDO;
use SQLite3;

// Database Connector
class Connector
{
    // Create A conn
    private $conn;
    private $sqlite3;
    // Mysql Connector

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $database
     */
    public function Mysql(string $host, string $user, string $password, string $database)
    {
        // Create Connector
        $this->conn = new mysqli($host, $user, $password, $database);
        // Try Catch Connect Error
        if ($this->conn->connect_errno) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        echo "Connected successfully";
    }

    // SQLite Connector

    /**
     * @param $db_file
     * @param $EncryptionKey
     */
    public function SQLite($db_file, $EncryptionKey)
    {
        // Create A SQLite3 Object
        $this->sqlite3 = new SQLite3($db_file, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, "$EncryptionKey");
        // Check Connector
        if ($this->sqlite3) {
            echo "Connected to the SQLite database successfully.";
        } else {
            echo "Unable to connect to the SQLite database.";
        }
    }

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $database
     */
    public function PostgreSQL(string $host, string $user, string $password, string $database)
    {
        // Create Connector
        $dsn = "pgsql:host=$host;dbname=$database";
        $this->conn = new PDO($dsn, $user, $password);
        // Set error mode to exceptions
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }


}