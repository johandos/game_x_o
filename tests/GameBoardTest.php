<?php

namespace Tests;

use App\Controllers\PlayersController;
use App\Services\GameBoardService;
use PHPUnit\Framework\TestCase;

class GameBoardTest extends TestCase
{
    public function test_validate_positions()
    {
        $gameBoard = new GameBoardService();
        $players = new PlayersController("Juan", "David");
    }

    public function test_validate_winner()
    {
        $gameBoard = new GameBoardService();
        $players = new PlayersController("Juan", "David");
    }
}