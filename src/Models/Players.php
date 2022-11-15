<?php


namespace App\Models;

use App\Utils\MySqlDB;

class Players extends MySqlDB
{
    public function getFirstPlayer(): array
    {
        return MySqlDB::executeQuery("SELECT * FROM players WHERE id = {$_SESSION['firstPlayer']} ")[0];
    }

    public function getSecondPlayer(): array
    {
        return MySqlDB::executeQuery("SELECT * FROM players WHERE id = {$_SESSION['secondPlayer']}")[0];
    }

    public function savePlayer($player): bool
    {
        return MySqlDB::executeInsert("INSERT INTO players (name) VALUES ('{$player}')");
    }

    public function getLastInsert(): int|string
    {
        return parent::getLastInsert();
    }
}