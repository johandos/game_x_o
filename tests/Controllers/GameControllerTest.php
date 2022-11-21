<?php

namespace Tests\Controllers;

use App\Services\GameBoardService;
use PHPUnit\Framework\TestCase;

class GameControllerTest extends TestCase
{
    public function test_game_index()
    {
    
    }
    
    public function test_validate_winner()
    {
        $gameBoard = new GameBoardService();
        $players = new PlayersController("Juan", "David");
    }
}