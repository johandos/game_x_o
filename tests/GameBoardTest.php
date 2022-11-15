<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\GameBoard;
use App\Players;

class GameBoardTest extends TestCase
{
    public function test_add_comment_to_post()
    {
        $gameBoard = new GameBoard();
        $players = new Players("Juan", "David");
    }
}