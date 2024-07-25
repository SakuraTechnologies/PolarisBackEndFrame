<?php

namespace DataBase;

use PDO;
use PDOException;

class SQLCommand
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function Search($table, $column, $value)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE $column = ?");
        $stmt->execute([$value]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Insert($table, $column, $value)
    {
        $stmt = $this->pdo->prepare("INSERT INTO $table ($column) VALUES (?)");
        $stmt->execute([$value]);
        return $this->pdo->lastInsertId();
    }

    public function Update($table, $column, $value, $new_value)
    {
        $stmt = $this->pdo->prepare("UPDATE $table SET $column = ? WHERE $column = ?");
        $stmt->execute([$new_value, $value]);
        return $stmt->rowCount() > 0;
    }

    public function Delete($table, $column, $value)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE $column = ?");
        $stmt->execute([$value]);
        return $stmt->rowCount() > 0;
    }

    public function CreateTable($table, $columns)
    {
        $sql = "CREATE TABLE $table (" . implode(', ', $columns) . ")";
        return $this->pdo->exec($sql);
    }

    public function DropTable($table)
    {
        $sql = "DROP TABLE IF EXISTS $table";
        return $this->pdo->exec($sql);
    }

    public function AddColumn($table, $column, $type)
    {
        $sql = "ALTER TABLE $table ADD COLUMN $column $type";
        return $this->pdo->exec($sql);
    }

    public function RemoveColumn($table, $column)
    {
        // Note: Removing columns is not directly supported by SQL standard.
        // This implementation works for MySQL and PostgreSQL but not SQLite.
        $sql = "ALTER TABLE $table DROP COLUMN $column";
        return $this->pdo->exec($sql);
    }

    public function ListTables()
    {
        $dbType = $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
        switch ($dbType) {
            case 'sqlite':
                $stmt = $this->pdo->query("SELECT name FROM sqlite_master WHERE type='table'");
                break;
            case 'mysql':
                $stmt = $this->pdo->query("SHOW TABLES");
                break;
            case 'pgsql':
                $stmt = $this->pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema='public'");
                break;
            default:
                throw new PDOException("Unsupported database driver: $dbType");
        }
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
