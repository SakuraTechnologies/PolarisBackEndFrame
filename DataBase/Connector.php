<?php

namespace DataBase;

use \mysqli;
use PDO;
use SQLite3;

// Database Connector
class Connector implements SQLTypeInterface
{
    // Create A conn
    private $conn;
    private $sqlite3;
    // Mysql Connector
    public function Mysql($host, $user, $password, $database)
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

    public function PostgreSQL($host, $user, $password, $database)
    {
        // Create Connector
        $dsn = "pgsql:host=$host;dbname=$database";
        $this->conn = new PDO($dsn, $user, $password);
        // Set error mode to exceptions
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }
}