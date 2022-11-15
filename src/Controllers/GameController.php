<?php

use App\Models\Game;
use App\Models\Players;
use App\Services\GameBoardService;
use App\Utils\Session;

$firstPlayer = new Players();
$session = new Session();

$firstPlayer->savePlayer($_POST["playerOne"]);
$firstPlayerId = $firstPlayer->getLastInsert();

$secondPlayer = new Players();
$secondPlayer->savePlayer($_POST["playerTwo"]);
$secondPlayerId = $secondPlayer->getLastInsert();

$session->setAttribute('firstPlayer', $firstPlayerId);
$session->setAttribute('secondPlayer', $secondPlayerId);

$initializeGame = new Game();
$gameBoard = new GameBoardService;
$gamePositions = $gameBoard->initialize();
$initializeGame->saveGame("");


die();