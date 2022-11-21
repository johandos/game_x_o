<?php

namespace App\Controllers;

use App\Models\Game;
use App\Models\Players;
use App\Services\GameBoardService;
use App\Services\WinValidatedService;
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
        Session::start();
        if (Session::existsAttribute('firstPlayer') && Session::existsAttribute('secondPlayer')){
            $firstPlayerId = Session::getAttribute('firstPlayer');
            $secondPlayerId = Session::getAttribute('secondPlayer');
            $playerTurn = Session::getAttribute('playerTurn');
            $player = new Players();
            $firstPlayer = $player->getPlayer($firstPlayerId);
            $secondPlayer = $player->getPlayer($secondPlayerId);
    
            $game = new Game();
            $game = $game->getGameInSession($firstPlayerId, $secondPlayerId);
    
            $validateGame = new WinValidatedService;
            $winner = $validateGame->validated($firstPlayerId, $secondPlayerId, $game["positions"]);
            if ($winner){
                $data['winner'] = $winner;
            }
    
            $data['firstPlayer'] = $firstPlayer;
            $data['secondPlayer'] = $secondPlayer;
            $data['gamePositions'] = $game["positions"];
            $data['playerTurn'] = $playerTurn;
            echo View::render('game/index', $data);
        }else{
            dd("session expirada");
        }
    }
    
    /**
     * @throws Exception
     */
    public function store()
    {
        if (Session::statusSession() != PHP_SESSION_NONE){
            Session::destroy();
        }
        
        $secondPlayer = new Players();
        $session = new Session();
    
        $firstPlayerId = $session->getAttribute('firstPlayer');
        $secondPlayerId = $session->getAttribute('secondPlayer');
        
        if (isset($_POST['restart'])){
            Session::deleteAttribute('gamePositions');
        }else{
            $firstPlayer = new Players();
            $firstPlayer->savePlayer($_POST["playerOne"]);
            $firstPlayerId = $firstPlayer->getLastInsert();
    
            $secondPlayer->savePlayer($_POST["playerTwo"]);
            $secondPlayerId = $secondPlayer->getLastInsert();
            
            $session->setAttribute('firstPlayer', $firstPlayerId);
            $session->setAttribute('secondPlayer', $secondPlayerId);
        }
    
        $gameBoard = new GameBoardService;
        $gamePositions = $gameBoard->initialize();
        
        $game = new Game();
        $game->saveGame($gamePositions, $firstPlayerId, $secondPlayerId);
        
        $session->setAttribute("turn", $session->getAttribute('firstPlayer'));
    
        $firstPlayer = new Players();
        $firstPlayer = $firstPlayer->getPlayer($firstPlayerId);
        $session->setAttribute("playerTurn", $firstPlayer['name']);
    
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