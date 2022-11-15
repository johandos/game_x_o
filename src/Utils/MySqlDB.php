<?php

namespace App\Utils;

use mysqli;

class MySqlDB
{
    protected string $host = "127.0.0.1";
    protected string $user = "root";
    protected string $pass = "";
    protected string $dbname = "game_x_o";
    protected mysqli|false $connection;

    function __construct()
    {
        $this->setConnection();
    }

    protected function setConnection(): void
    {
        $this->connection = @mysqli_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname,
        );
        $this->connection->set_charset('utf8');
    }

    protected function getConnection(): bool|mysqli
    {
        return $this->connection;
    }

    protected function executeQuery($sql): array
    {
        $data = [];
        $result = mysqli_query($this->getConnection(), $sql);
        if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }

        return $data;
    }

    protected function numRows($sql): int
    {
        $result = mysqli_query($this->connection, $sql);
        return mysqli_num_rows($result);
    }

    protected function getDataSingle($sql): array|null
    {
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0){
            return mysqli_fetch_assoc($result);
        }

        return null;
    }

    protected function getLastId(): int|string
    {
        return mysqli_insert_id($this->connection);
    }

    protected function close(): void
    {
        mysqli_close($this->connection);
    }
}