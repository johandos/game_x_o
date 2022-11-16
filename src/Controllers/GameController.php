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
    
        $player = new Players();
        $firstPlayer = $player->getPlayer($firstPlayerSession);
        $secondPlayer = $player->getPlayer($secondPlayerSession);
        $playerTurn = $playerTurn ?? $session->getAttribute('turn');
    
        $game = new Game();
    
        $data['firstPlayer'] = $firstPlayer;
        $data['secondPlayer'] = $secondPlayer;
        $data['gamePositions'] = $game->getGameInSession()["positions"];
        $data['turn'] = $playerTurn;
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
        
        $firstPlayer = $firstPlayer->getPlayer($firstPlayerId ?? $session->getAttribute('firstPlayer'));
        $secondPlayer = $secondPlayer->getPlayer($secondPlayerId ?? $session->getAttribute('secondPlayer'));
    
        $game = new Game();
        $gameBoard = new GameBoardService;
        $gamePositions = $gameBoard->initialize();
        $game->saveGame($gamePositions);
    
        $data['firstPlayer'] = $firstPlayer;
        $data['secondPlayer'] = $secondPlayer;
        $data['gamePositions'] = $gamePositions;
        $data['turn'] = $session->getAttribute('turn');
        echo View::render('game/index', $data);
    }
    
    public function savePosition()
    {
        $session = new Session();
        $firstPlayerSession = $session->getAttribute('firstPlayer');
        $secondPlayerSession = $session->getAttribute('secondPlayer');
        $playerTurn = $session->getAttribute('turn');
    
        $player = new Players();
        $firstPlayer = $player->getPlayer($firstPlayerSession);
        $secondPlayer = $player->getPlayer($secondPlayerSession);
    
        $game = new Game();
    
        $gameBoard = new GameBoardService;
        
        if (isset($_GET['position'])):
            $game = new Game();
            $gameSession = $game->getGameInSession();
            $gameBoard->savePositionInGame($_GET['position'], $playerTurn, $gameSession["id"]);
            $playerTurn == $firstPlayer['id'] ? $session->setAttribute('turn', $secondPlayer['id']) : $session->setAttribute('turn', $firstPlayer['id']);
        endif;
    
    
        $data['firstPlayer'] = $firstPlayer;
        $data['secondPlayer'] = $secondPlayer;
        $data['gamePositions'] = $game->getGameInSession()["positions"];
        $data['turn'] = $playerTurn;
        echo View::render('game/index', $data);
    }
}