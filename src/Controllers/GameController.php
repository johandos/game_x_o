<?php

namespace App\Controllers;

use App\Models\Game;
use App\Models\Players;
use App\Services\GameBoardService;
use App\Utils\Session;
use App\Utils\View;
use Exception;

class GameController extends View
{
    private int $playerTurn;
    private int $firstPlayerId;
    private int $secondPlayerId;
    private Session $session;
    
    public function __constructor(){
        $this->session = new Session();
        $this->playerTurn = $this->session->getAttribute('turn');
        $this->firstPlayerId = $this->session->getAttribute('firstPlayer');
        $this->secondPlayerId = $this->session->getAttribute('secondPlayer');
    }
    
    public function index()
    {
        $game = new Game();
        $player = new Players();
        $firstPlayerId = $player->getPlayer($this->firstPlayerId);
        $secondPlayerId = $player->getPlayer($this->secondPlayerId);
    
        $data['firstPlayer'] = $firstPlayerId;
        $data['secondPlayer'] = $secondPlayerId;
        $data['gamePositions'] = $game->getGameInSession($firstPlayerId, $secondPlayerId)["positions"];
        $data['playerTurn'] = $this->playerTurn;
        echo View::render('game/index', $data);
    }
    
    public function store()
    {
        $firstPlayer = new Players();
        $secondPlayer = new Players();
        $session = new Session();
        
        if (isset($_POST['restart'])){
            Session::deleteAttribute('gamePositions');
        }else{
            $firstPlayer->savePlayer($_POST["playerOne"]);
            $firstPlayerId = $firstPlayer->getLastInsert();
    
            $secondPlayer->savePlayer($_POST["playerTwo"]);
            $secondPlayerId = $secondPlayer->getLastInsert();
            
            $session->setAttribute('firstPlayer', $firstPlayerId);
            $session->setAttribute('secondPlayer', $secondPlayerId);
        }
        
        $session->setAttribute("turn", $this->firstPlayerId);
        $player = new Players();
        $playerTurnName = $player->getPlayer($this->firstPlayerId);
        $session->setAttribute("playerTurn", $playerTurnName['name']);
        
        $game = new Game();
        $gameBoard = new GameBoardService;
        $gamePositions = $gameBoard->initialize();
        $game->saveGame($gamePositions, $this->firstPlayerId, $this->secondPlayerId);
    
        header('Location: /game/index');
    }
    
    /**
     * @throws Exception
     */
    public function savePosition()
    {
        $game = new Game();
        $gameInSession = $game->getGameInSession($this->firstPlayerId, $this->secondPlayerId);
        $nextTurn = $this->playerTurn == $this->firstPlayerId ? $this->secondPlayerId : $this->firstPlayerId;
    
        if (isset($_GET['position']) && isset($_GET['positionValue'])){
            GameBoardService::updateGamePosition($_GET['position'], $gameInSession["id"], $this->playerTurn);
            $this->session->setAttribute("turn", $nextTurn);
            $player = new Players();
            $playerTurnName = $player->getPlayer($nextTurn);
            $this->session->setAttribute("playerTurn", $playerTurnName['name']);
        }
        
        header('Location: /game/index');
    }
}