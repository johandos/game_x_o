<?php

namespace App\Services;

use App\Models\Game;
use App\Utils\Session;

class WinValidatedService
{
    public function validated(): string
    {
        $winner = false;

        $gameInSession = new Game();
        $gameInSession = $gameInSession->getGameInSession();
        $gameInSession = json_decode($gameInSession["positions"]);

        $session = new Session();
        $firstPlayerSession = $session->getAttribute('firstPlayer');
        $secondPlayerSession = $session->getAttribute('secondPlayer');

        if ($gameInSession->{"pos11"} == $firstPlayerSession && $gameInSession->{"pos21"} == $firstPlayerSession && $gameInSession->{"pos31"} == $firstPlayerSession){
            $winner = $firstPlayerSession;
        }

        if ($gameInSession->{"pos21"} == $secondPlayerSession && $gameInSession->{"pos22"} == $secondPlayerSession && $gameInSession->{"pos23"} == $secondPlayerSession){
            $winner = $secondPlayerSession;
        }

        if ($gameInSession->{"pos21"} == $firstPlayerSession && $gameInSession->{"pos22"} == $firstPlayerSession && $gameInSession->{"pos23"} == $firstPlayerSession){
            $winner = $firstPlayerSession;
        }

        if ($gameInSession->{"pos31"} == $secondPlayerSession && $gameInSession->{"pos32"} == $secondPlayerSession && $gameInSession->{"pos33"} == $secondPlayerSession){
            $winner = $secondPlayerSession;
        }

        if ($gameInSession->{"pos31"} == $firstPlayerSession && $gameInSession->{"pos32"} == $firstPlayerSession && $gameInSession->{"pos33"} == $firstPlayerSession){
            $winner = $firstPlayerSession;
        }

        if ($gameInSession->{"pos11"} == $secondPlayerSession && $gameInSession->{"pos12"} == $secondPlayerSession && $gameInSession->{"pos13"} == $secondPlayerSession){
            $winner = $secondPlayerSession;
        }

        if ($gameInSession->{"pos11"} == $firstPlayerSession && $gameInSession->{"pos12"} == $firstPlayerSession && $gameInSession->{"pos13"} == $firstPlayerSession){
            $winner = $firstPlayerSession;
        }

        if ($gameInSession->{"pos12"} == $secondPlayerSession && $gameInSession->{"pos22"} == $secondPlayerSession && $gameInSession->{"pos32"} == $secondPlayerSession){
            $winner = $secondPlayerSession;
        }

        if ($gameInSession->{"pos12"} == $firstPlayerSession && $gameInSession->{"pos22"} == $firstPlayerSession && $gameInSession->{"pos32"} == $firstPlayerSession){
            $winner = $firstPlayerSession;
        }

        if ($gameInSession->{"pos13"} == $secondPlayerSession && $gameInSession->{"pos23"} == $secondPlayerSession && $gameInSession->{"pos33"} == $secondPlayerSession){
            $winner = $secondPlayerSession;
        }

        if ($gameInSession->{"pos13"} == $firstPlayerSession && $gameInSession->{"pos23"} == $firstPlayerSession && $gameInSession->{"pos33"} == $firstPlayerSession){
            $winner = $firstPlayerSession;
        }

        if ($gameInSession->{"pos13"} == $secondPlayerSession && $gameInSession->{"pos22"} == $secondPlayerSession && $gameInSession->{"pos31"} == $secondPlayerSession){
            $winner = $secondPlayerSession;
        }

        if ($gameInSession->{"pos13"} == $firstPlayerSession && $gameInSession->{"pos22"} == $firstPlayerSession && $gameInSession->{"pos31"} == $firstPlayerSession){
            $winner = $firstPlayerSession;
        }

        if ($gameInSession->{"pos11"} == $secondPlayerSession && $gameInSession->{"pos22"} == $secondPlayerSession && $gameInSession->{"pos33"} == $secondPlayerSession){
            $winner = $secondPlayerSession;
        }

        if ($gameInSession->{"pos11"} == $firstPlayerSession && $gameInSession->{"pos22"} == $firstPlayerSession && $gameInSession->{"pos33"} == $firstPlayerSession){
            $winner = $firstPlayerSession;
        }

        return $winner;
    }
}
