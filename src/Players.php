<?php

namespace App;

class Players
{
    public function __construct($nameOne, $nameTwo)
    {
        if($nameOne == "") $nameOne = "Jugador 1";
        if($nameTwo == "") $nameTwo = "Jugador 2";
        $_SESSION["firstPlayer"] = $nameOne;
        $_SESSION["secondPlayer"] = $nameTwo;
    }
}