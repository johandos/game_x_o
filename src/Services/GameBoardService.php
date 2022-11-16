<?php

namespace App\Services;

use App\Models\Game;
use App\Utils\Session;

class GameBoardService
{
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

    public function savePositionInGame($position, $gameId, $playerTurn): void
    {
        $game = new Game();
        $game->updateGamePosition($position, $gameId, $playerTurn);
    }
}
