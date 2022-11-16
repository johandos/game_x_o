<?php

namespace App\Models;

use App\Utils\MySqlDB;
use App\Utils\Session;

class Game
{
    private MySqlDB $mySqlDB;
    private mixed $firstPlayer;
    private mixed $secondPlayer;

    public function __construct()
    {
        $this->mySqlDB = new MySqlDB();

        $session = new Session();
        $this->firstPlayer = $session->getAttribute('firstPlayer');
        $this->secondPlayer = $session->getAttribute('secondPlayer');
    }

    public function getGameInSession(): array
    {
        return $this->mySqlDB->executeQuery("SELECT * FROM games 
         WHERE first_player_id = {$this->firstPlayer} AND second_player_id = {$this->secondPlayer} ORDER BY id DESC")[0];
    }

    public function saveGame($gamePositions): bool
    {
        $this->mySqlDB->executeInsert("INSERT INTO games (first_player_id, second_player_id, positions) 
            VALUES ('{$this->firstPlayer}', '{$this->secondPlayer}', '{$gamePositions}')");
        return true;
    }

    public function updateGamePosition($position, $valuePosition, $gameId): bool
    {
        return $this->mySqlDB->executeInsert("UPDATE games SET positions = JSON_SET(positions, '$.$position', '$valuePosition') WHERE id = {$gameId}");
    }
}