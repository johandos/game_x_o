<?php
    
    namespace Tests\Models;
    
    use App\Controllers\PlayersController;
    use App\Models\Game;
    use App\Services\GameBoardService;
    use App\Utils\Session;
    use PHPUnit\Framework\MockObject\MockBuilder;
    use PHPUnit\Framework\TestCase;
    
    class GamesTest extends TestCase
    {
        private Session $firstPlayer;
        private Session $secondPlayer;
    
        public function test_game_in_session()
        {
            $_SESSION['firstPlayer'] = 'Juan';
            $_SESSION['secondPlayer'] = 'David';
            
            $game = new Game();
            $this->assertIsArray($game->getGameInSession());
        }
    }