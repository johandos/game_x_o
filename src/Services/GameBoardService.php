<?php

namespace App\Services;

use App\Models\Game;
use App\Utils\Session;

class GameBoardService
{
    public function showPositions($positionToShow, $positionValue, $playerTurn): string
    {
        $session = new Session();
        $firstPlayer = $session->getAttribute('firstPlayer');
        $secondPlayer = $session->getAttribute('secondPlayer');

        return match ((int)$positionValue) {
            $firstPlayer => "<img width='20px' src=\"../../public/img/o.jpg\"  alt='' />",
            $secondPlayer => "<img width='20px' src=\"../../public/img/x.jpg\"  alt='' />",
            default => "<a href=\"index.php?position=" . $positionToShow . "&turn=" . $playerTurn . "\"><img width='20px' src=\"../../public/img/default.png\"  alt='defaultImg' /></a>",
        };
    }

    public static function initialize(): string
    {
        $positions = [];

        $positions['pos11'] = "0";
        $positions['pos12'] = "0";
        $positions['pos13'] = "0";
        $positions['pos21'] = "0";
        $positions['pos22'] = "0";
        $positions['pos23'] = "0";
        $positions['pos31'] = "0";
        $positions['pos32'] = "0";
        $positions['pos33'] = "0";

        return json_encode($positions);
    }

    public function savePositionInGame($position, $valuePosition, $gameId): void
    {
        $game = new Game();
        $game->updateGamePosition($position, $valuePosition, $gameId);
    }
}
