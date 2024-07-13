<?php

namespace DataBase;

interface SQLCommandTypeInterface
{
    /**
     * Search Data in Mysql Database
     * @param $table
     * @param $column
     * @param $value
     * @return mixed
     */

    public function Search($table, $column, $value);

    /**
     * Insert Data in Mysql Database
     * @param $table
     * @param $column
     * @param $value
     * @return mixed
     */

    public function Insert($table, $column, $value);

    /**
     * Update Data in Mysql Database
     * @param $table
     * @param $column
     * @param $value
     * @param $new_value
     * @return mixed
     */
    public function Update($table, $column, $value, $new_value);

    /**
     * Delete Data in Mysql Database
     * @param $table
     * @param $column
     * @param $value
     * @return mixed
     */
    public function Delete($table, $column, $value);

    /**
     * Create Table in Mysql Database
     * @param $column
     * @param $datatype
     * @param $constraints
     * @return mixed
     */

    public function CreateTable($table, $columns);

    /**
     * Drop an existing table from the database.
     * @param string $table The name of the table to drop.
     * @return bool True if the table was dropped successfully.
     */
    public function DropTable($table);

    /**
     * Add a new column to an existing table.
     * @param string $table The name of the table.
     * @param string $column The name of the new column.
     * @param string $type The data type of the new column.
     * @return bool True if the column addition was successful.
     */
    public function AddColumn($table, $column, $type);

    /**
     * Remove a column from an existing table.
     * @param string $table The name of the table.
     * @param string $column The name of the column to remove.
     * @return bool True if the column removal was successful.
     */
    public function RemoveColumn($table, $column);

    /**
     * List all tables in the current database.
     * @return array An array of table names.
     */
    public function ListTables();
}