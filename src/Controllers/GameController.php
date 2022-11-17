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
    /**
     * @throws Exception
     */
    public function index()
    {
        $session = new Session();
        $firstPlayerId = $session->getAttribute('firstPlayer');
        $secondPlayerId = $session->getAttribute('secondPlayer');
        $playerTurn = $session->getAttribute('playerTurn');
    
        $player = new Players();
        $firstPlayer = $player->getPlayer($firstPlayerId);
        $secondPlayer = $player->getPlayer($secondPlayerId);
    
        $game = new Game();
    
        $data['firstPlayer'] = $firstPlayer;
        $data['secondPlayer'] = $secondPlayer;
        $data['gamePositions'] = $game->getGameInSession($firstPlayerId, $secondPlayerId)["positions"];
        $data['playerTurn'] = $playerTurn;
        echo View::render('game/index', $data);
    }
    
    public function store()
    {
        if (Session::statusSession() != PHP_SESSION_NONE){
            Session::destroySession();
        }
        
        $firstPlayer = new Players();
        $secondPlayer = new Players();
        $session = new Session();
    
        $firstPlayerId = $session->getAttribute('firstPlayer');
        $secondPlayerId = $session->getAttribute('secondPlayer');
        
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
        
        $game = new Game();
        $gameBoard = new GameBoardService;
        $gamePositions = $gameBoard->initialize();
        $game->saveGame($gamePositions, $firstPlayerId, $secondPlayerId);
        $session->setAttribute("turn", $session->getAttribute('firstPlayer'));
    
        header('Location: /game/index');
    }
    
    /**
     * @throws Exception
     */
    public function savePosition()
    {
        $session = new Session();
        $firstPlayerId = $session->getAttribute('firstPlayer');
        $secondPlayerId = $session->getAttribute('secondPlayer');
        $game = new Game();
        $gameInSession = $game->getGameInSession($firstPlayerId, $secondPlayerId);
        $session = new Session();
        $playerTurn = $session->getAttribute('turn');
        $firstPlayer = $session->getAttribute('firstPlayer');
        $secondPlayer = $session->getAttribute('secondPlayer');
        $nextTurn = $playerTurn == $firstPlayer ? $secondPlayer : $firstPlayer;
    
        if (isset($_GET['position'])){
            GameBoardService::updateGamePosition($_GET['position'], $gameInSession["id"], $playerTurn);
            $session->setAttribute("turn", $nextTurn);
            $player = new Players();
            $playerTurnName = $player->getPlayer($nextTurn);
            $session->setAttribute("playerTurn", $playerTurnName['name']);
        }
        
        header('Location: /game/index');
    }
}