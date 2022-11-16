<?php

namespace App\Controllers;

use App\Models\Game;
use App\Models\Players;
use App\Services\GameBoardService;
use App\Utils\Session;
use App\Utils\View;

class GameController extends View
{
    public function index()
    {
        $session = new Session();
        $firstPlayerSession = $session->getAttribute('firstPlayer');
        $secondPlayerSession = $session->getAttribute('secondPlayer');
        $playerTurn = $session->getAttribute('playerTurn');
    
        $player = new Players();
        $firstPlayer = $player->getPlayer($firstPlayerSession);
        $secondPlayer = $player->getPlayer($secondPlayerSession);
    
        $game = new Game();
    
        $data['firstPlayer'] = $firstPlayer;
        $data['secondPlayer'] = $secondPlayer;
        $data['gamePositions'] = $game->getGameInSession()["positions"];
        $data['playerTurn'] = $playerTurn;
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
        
        $session->setAttribute("turn", $session->getAttribute('firstPlayer'));
        $player = new Players();
        $playerTurnName = $player->getPlayer($session->getAttribute('firstPlayer'));
        $session->setAttribute("playerTurn", $playerTurnName['name']);
        
        $game = new Game();
        $gameBoard = new GameBoardService;
        $gamePositions = $gameBoard->initialize();
        $game->saveGame($gamePositions);
    
        header('Location: /game/index');
    }
    
    public function savePosition()
    {
        $game = new Game();
        $gameInSession = $game->getGameInSession();
        $gameBoard = new GameBoardService;
        $session = new Session();
        $playerTurn = $session->getAttribute('turn');
        $firstPlayer = $session->getAttribute('firstPlayer');
        $secondPlayer = $session->getAttribute('secondPlayer');
        $nextTurn = $playerTurn == $firstPlayer ? $secondPlayer : $firstPlayer;
    
        if (isset($_GET['position']) && isset($_GET['positionValue'])){
            $gameBoard->savePositionInGame($_GET['position'], $gameInSession["id"], $playerTurn);
            $session->setAttribute("turn", $nextTurn);
            $player = new Players();
            $playerTurnName = $player->getPlayer($nextTurn);
            $session->setAttribute("playerTurn", $playerTurnName['name']);
        }
        
        header('Location: /game/index');
    }
}