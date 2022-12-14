<?php

namespace App\Models;

use App\Utils\MySqlDB;
use App\Utils\Session;
use Exception;

class Game extends MySqlDB
{
    /**
     * @throws Exception
     */
    public function getGameInSession($firstPlayerId, $secondPlayerId): string|array
    {
        // get the last game in BD found by players in session
        $games = MySqlDB::executeQuery("SELECT * FROM games WHERE first_player_id = {$firstPlayerId} AND second_player_id = {$secondPlayerId} ORDER BY id DESC");

        if (!empty($games)){
            return $games[0];
        }
        
        throw new Exception("Error al encontrar el juego en session");
    }

    public static function saveGame($gamePositions, $firstPlayerId, $secondPlayerId): bool
    {
        return MySqlDB::executeInsert("INSERT INTO games (first_player_id, second_player_id, positions)
            VALUES ('{$firstPlayerId}', '{$secondPlayerId}', '{$gamePositions}')");
    }

    public function updateGamePosition($position, $gameId, $playerTurn): bool
    {
        return MySqlDB::executeInsert("UPDATE games SET positions = JSON_SET(positions, '$.$position', '$playerTurn') WHERE id = {$gameId}");
    }
}