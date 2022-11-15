<?php

namespace App\Services;

class GameBoardService
{
    public function showPositions($positionToShow, $playerTurn): string
    {
        $valor = match ($positionToShow) {
            "11" => $_SESSION['pos11'],
            "12" => $_SESSION['pos12'],
            "13" => $_SESSION['pos13'],
            "21" => $_SESSION['pos21'],
            "22" => $_SESSION['pos22'],
            "23" => $_SESSION['pos23'],
            "31" => $_SESSION['pos31'],
            "32" => $_SESSION['pos32'],
            "33" => $_SESSION['pos33'],
            default => "0",
        };

        return match ($valor) {
            "1" => "<img width='20px' src=\"../public/img/o.jpg\"  alt='' />",
            "2" => "<img width='20px' src=\"../public/img/x.jpg\"  alt='' />",
            default => "<a href=\"index.php?pos=" . $positionToShow . "&turn=" . $playerTurn . "\"><img width='20px' src=\"../public/img/default.png\"  alt='defaultImg' /></a>",
        };
    }

    public static function initialize(): void
    {
        $_SESSION['pos11'] = "0";
        $_SESSION['pos12'] = "0";
        $_SESSION['pos13'] = "0";
        $_SESSION['pos21'] = "0";
        $_SESSION['pos22'] = "0";
        $_SESSION['pos23'] = "0";
        $_SESSION['pos31'] = "0";
        $_SESSION['pos32'] = "0";
        $_SESSION['pos33'] = "0";
    }

    public function savePositionInGame($positionToSave, $player): void
    {
        switch ($positionToSave) {
            case '11':
                $_SESSION['pos11'] = $player;
                break;
            case '12':
                $_SESSION['pos12'] = $player;
                break;
            case '13':
                $_SESSION['pos13'] = $player;
                break;
            case '21':
                $_SESSION['pos21'] = $player;
                break;
            case '22':
                $_SESSION['pos22'] = $player;
                break;
            case '23':
                $_SESSION['pos23'] = $player;
                break;
            case '31':
                $_SESSION['pos31'] = $player;
                break;
            case '32':
                $_SESSION['pos32'] = $player;
                break;
            case '33':
                $_SESSION['pos33'] = $player;
                break;
            default:
                break;
        }
    }
}
