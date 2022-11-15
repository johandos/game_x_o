<?php


namespace App\Models;

use App\Utils\MySqlDB;

class Game extends MySqlDB
{
    public function getGameInSession(): array
    {
        $data = MySqlDB::executeQuery("SELECT * FROM games 
         WHERE first_player_id = {$_SESSION['firstPlayer']} 
           AND second_player_id = {$_SESSION['secondPlayer']}");

        MySqlDB::close();
        return $data;
    }
}