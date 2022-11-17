<?php
    
    namespace Tests\Models;
    
    use App\Controllers\PlayersController;
    use App\Models\Game;
    use App\Services\GameBoardService;
    use App\Utils\Session;
    use Exception;
    use PHPUnit\Framework\MockObject\MockBuilder;
    use PHPUnit\Framework\TestCase;
    
    class GamesTest extends TestCase
    {
        /**
         * @throws Exception
         */
        public function test_game_in_session()
        {
            $firstPlayerId = 1;
            $secondPlayerId = 2;
    
            $game = new Game();
            $gameInSession = $game->getGameInSession($firstPlayerId, $secondPlayerId);
            
            $this->assertIsArray($gameInSession);
            $this->assertEquals($firstPlayerId, $gameInSession['id']);
        }
    
        /**
         * @throws Exception
         */
        public function test_game_in_session_not_exist()
        {
            $firstPlayerId = 1000;
            $secondPlayerId = 2000;
        
            $game = new Game();
            $this->expectException(Exception::class);
            $game->getGameInSession($firstPlayerId, $secondPlayerId);
        }
    
        /**
         * @throws Exception
         */
        public function test_save_game()
        {
            $firstPlayerId = 1;
            $secondPlayerId = 2;
            $gameBoard = new GameBoardService;
            $gamePositions = $gameBoard->initialize();
        
            $game = new Game();
            $this->assertJson($gamePositions);
            $this->assertTrue($game->saveGame($gamePositions, $firstPlayerId, $secondPlayerId));
        }
    
        /**
         * @throws Exception
         */
        public function test_updated_position_game()
        {
            $firstPlayerId = 1;
            $playerTurn = 1;
            $secondPlayerId = 2;
            $position = "pos12";
            $game = new Game();
            $gameInSession = $game->getGameInSession($firstPlayerId, $secondPlayerId);
            $this->assertTrue($game->updateGamePosition($position, $gameInSession['id'], $playerTurn));
        }
    
        /**
         * @throws Exception
         */
        public function test_updated_null_position()
        {
            $firstPlayerId = 1;
            $playerTurn = 1;
            $secondPlayerId = 2;
            $game = new Game();
            $gameInSession = $game->getGameInSession($firstPlayerId, $secondPlayerId);
            $this->expectException(Exception::class);
            $game->updateGamePosition(null, $gameInSession['id'], $playerTurn);
        }
    }