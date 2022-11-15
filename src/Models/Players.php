<?php


namespace App\Models;

use App\MySqlDB;

class Players extends MySqlDB
{
    public function getFirstPlayer(): array
    {
        $data = MySqlDB::executeQuery("SELECT * FROM games 
         WHERE first_player_id = {$_SESSION['firstPlayer']} 
           AND second_player_id = {$_SESSION['secondPlayer']}");

        MySqlDB::close();
        return $data;
    }

    public function getSecondPlayer(): array
    {
        $data = MySqlDB::executeQuery("SELECT * FROM games 
         WHERE first_player_id = {$_SESSION['firstPlayer']} 
           AND second_player_id = {$_SESSION['secondPlayer']}");

        MySqlDB::close();
        return $data;
    }
}