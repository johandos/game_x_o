<?php

namespace App\Controllers;

class PlayersController
{
    public function __construct($nameOne, $nameTwo)
    {
        if($nameOne == "") $nameOne = "Jugador 1";
        if($nameTwo == "") $nameTwo = "Jugador 2";
        $_SESSION["firstPlayer"] = $nameOne;
        $_SESSION["secondPlayer"] = $nameTwo;
    }
}