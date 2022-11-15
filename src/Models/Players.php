<?php


namespace App\Models;

use App\Utils\MySqlDB;
use App\Utils\Session;

class Players extends MySqlDB
{
    public function getPlayer($player): array
    {
        return MySqlDB::executeQuery("SELECT * FROM players WHERE id = {$player} ")[0];
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