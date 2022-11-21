<?php

namespace App\Utils;

use mysqli;

class MySqlDB
{
    protected mysqli|false $connection;

    function __construct()
    {
        $this->setConnection();
    }

    protected function setConnection(): void
    {
        $this->connection = @mysqli_connect(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            $_ENV['DB_DBNAME']
        );
        $this->connection->set_charset('utf8');
    }

    protected function getConnection(): bool|mysqli
    {
        return $this->connection;
    }

    public function executeQuery($sql): array
    {
        $data = [];
        $result = mysqli_query(self::getConnection(), $sql);

        if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }

        return $data;
    }

    public static function executeInsert($sql): bool
    {
        $connection = new self();
        return mysqli_query($connection->getConnection(), $sql);
    }

    protected function getLastInsert(): int|string
    {
        return mysqli_insert_id($this->connection);
    }

    protected function close(): void
    {
        mysqli_close($this->connection);
    }
}