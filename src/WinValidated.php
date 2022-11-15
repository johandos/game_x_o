<?php

namespace App;

class WinValidated
{
    public function validated(): string
    {
        $winner = false;

        if ($_SESSION["pos11"] == "1" && $_SESSION["pos21"] == "1" && $_SESSION["pos31"] == "1"){
            $winner = $_SESSION["secondPlayer"];
        }

        if ($_SESSION["pos21"] == "2" && $_SESSION["pos22"] == "2" && $_SESSION["pos23"] == "2"){
            $winner = $_SESSION["firstPlayer"];
        }

        if ($_SESSION["pos21"] == "1" && $_SESSION["pos22"] == "1" && $_SESSION["pos23"] == "1"){
            $winner = $_SESSION["secondPlayer"];
        }

        if ($_SESSION["pos31"] == "2" && $_SESSION["pos32"] == "2" && $_SESSION["pos33"] == "2"){
            $winner = $_SESSION["firstPlayer"];
        }

        if ($_SESSION["pos31"] == "1" && $_SESSION["pos32"] == "1" && $_SESSION["pos33"] == "1"){
            $winner = $_SESSION["secondPlayer"];
        }

        if ($_SESSION["pos11"] == "2" && $_SESSION["pos12"] == "2" && $_SESSION["pos13"] == "2"){
            $winner = $_SESSION["firstPlayer"];
        }

        if ($_SESSION["pos11"] == "1" && $_SESSION["pos12"] == "1" && $_SESSION["pos13"] == "1"){
            $winner = $_SESSION["secondPlayer"];
        }

        if ($_SESSION["pos12"] == "2" && $_SESSION["pos22"] == "2" && $_SESSION["pos32"] == "2"){
            $winner = $_SESSION["firstPlayer"];
        }

        if ($_SESSION["pos12"] == "1" && $_SESSION["pos22"] == "1" && $_SESSION["pos32"] == "1"){
            $winner = $_SESSION["secondPlayer"];
        }

        if ($_SESSION["pos13"] == "2" && $_SESSION["pos23"] == "2" && $_SESSION["pos33"] == "2"){
            $winner = $_SESSION["firstPlayer"];
        }

        if ($_SESSION["pos13"] == "1" && $_SESSION["pos23"] == "1" && $_SESSION["pos33"] == "1"){
            $winner = $_SESSION["secondPlayer"];
        }

        if ($_SESSION["pos13"] == "2" && $_SESSION["pos22"] == "2" && $_SESSION["pos31"] == "2"){
            $winner = $_SESSION["firstPlayer"];
        }

        if ($_SESSION["pos13"] == "1" && $_SESSION["pos22"] == "1" && $_SESSION["pos31"] == "1"){
            $winner = $_SESSION["secondPlayer"];
        }

        if ($_SESSION["pos11"] == "2" && $_SESSION["pos22"] == "2" && $_SESSION["pos33"] == "2"){
            $winner = $_SESSION["firstPlayer"];
        }

        if ($_SESSION["pos11"] == "1" && $_SESSION["pos22"] == "1" && $_SESSION["pos33"] == "1"){
            $winner = $_SESSION["secondPlayer"];
        }

        return $winner;
    }
}
