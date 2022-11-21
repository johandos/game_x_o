<?php

namespace App\Models;

use App\Utils\MySqlDB;
use App\Utils\Session;
use Exception;

class Players extends MySqlDB
{
    /**
     * @throws Exception
     */
    public function getPlayer(int $id): array
    {
        // get the last game in BD found by players in session
        $player = parent::executeQuery("SELECT * FROM players WHERE id = {$id} ");
        if (!empty($player)){
            return $player[0];
        }
    
        throw new Exception("Error al encontrar el jugador");
    }

    public static function savePlayer(string $name): bool
    {
        return parent::executeInsert("INSERT INTO players (name) VALUES ('{$name}')");
    }

    public function getLastInsert(): int|string
    {
        return parent::getLastInsert();
    }
}