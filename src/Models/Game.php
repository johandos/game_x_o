<?php


namespace App\Models;

use App\Utils\MySqlDB;

class Game extends MySqlDB
{
    public function getGameInSession(): array
    {
        return MySqlDB::executeQuery("SELECT * FROM games 
         WHERE first_player_id = {$_SESSION['firstPlayer']} 
           AND second_player_id = {$_SESSION['secondPlayer']}")[0];
    }

    public function saveGame($gamePositions): bool
    {
        MySqlDB::executeInsert("INSERT INTO games (first_player_id, second_player_id, positions) 
            VALUES ('{$_SESSION['firstPlayer']}', '{$_SESSION['secondPlayer']}', '{$gamePositions}')");
        return true;
    }

    public function updateGamePosition($position, $valuePosition, $gameId): bool
    {
        return MySqlDB::executeInsert("UPDATE games SET positions = JSON_SET(positions, '$.$position', '$valuePosition') WHERE id = {$gameId}");
    }
}