<?php

namespace App;

use mysqli;

class MySqlDB
{
    private string $host = "127.0.0.1";
    private string $user = "root";
    private string $pass = "";
    private string $dbname = "game_x_o";
    private mysqli|false $connection;

    function __construct()
    {
        $this->setConnection();
    }

    public function setConnection(): void
    {
        $this->connection = @mysqli_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname,
        );
        $this->connection->set_charset('utf8');
    }

    public function getConnection(): bool|mysqli
    {
        return $this->connection;
    }

    public function executeQuery($sql): array
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

    public function numRows($sql): int
    {
        $result = mysqli_query($this->connection, $sql);
        return mysqli_num_rows($result);
    }

    public function getDataSingle($sql): array|null
    {
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0){
            return mysqli_fetch_assoc($result);
        }

        return null;
    }

    public function getLastId(): int|string
    {
        return mysqli_insert_id($this->connection);
    }

    public function close(): void
    {
        mysqli_close($this->connection);
    }
}