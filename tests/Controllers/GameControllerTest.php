<?php

namespace Tests\Controllers;

use App\Controllers\PlayersController;
use App\Services\GameBoardService;
use PHPUnit\Framework\TestCase;

class GameControllerTest extends TestCase
{
    
    
    public function test_start_game()
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