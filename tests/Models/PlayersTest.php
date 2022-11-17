<?php

namespace Tests\Models;

use App\Models\Game;
use App\Models\Players;
use App\Services\GameBoardService;
use Exception;
use PHPUnit\Framework\TestCase;

class PlayersTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_get_player()
    {
        $firstPlayerId = 1;

        $game = new Players();
        $firstPlayer = $game->getPlayer($firstPlayerId);
        $this->assertIsArray($firstPlayer);
        $this->assertEquals($firstPlayerId, $firstPlayer['id']);
    }

    /**
     * @throws Exception
     */
    public function test_player_not_exist()
    {
        $firstPlayerId = 1000;
        $game = new Players();
        $this->expectException(Exception::class);
        $game->getPlayer($firstPlayerId);
    }

    /**
     * @throws Exception
     */
    public function test_save_player()
    {
        $firstPlayerId = 'Test Name';
        $game = new Players();
        $this->assertTrue($game->savePlayer($firstPlayerId));
    }
}