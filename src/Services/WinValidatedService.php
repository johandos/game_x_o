<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Players;
use App\Utils\Session;
use Exception;

class WinValidatedService
{
    /**
     * @throws Exception
     */
    public function validated(int $firstPlayerId, int $secondPlayerId, string $gameInSession): string
    {
        $winner = false;
    
        $gameInSession = json_decode($gameInSession);
    
        $player = new Players();
        $firstPlayer = $player->getPlayer($firstPlayerId);
        $secondPlayer = $player->getPlayer($secondPlayerId);
    
        if ($gameInSession->{"pos11"} == $firstPlayerId && $gameInSession->{"pos21"} == $firstPlayerId && $gameInSession->{"pos31"} == $firstPlayerId){
            $winner = $firstPlayer['name'];
        }
    
        if ($gameInSession->{"pos11"} == $secondPlayerId && $gameInSession->{"pos21"} == $secondPlayerId && $gameInSession->{"pos31"} == $secondPlayerId){
            $winner = $secondPlayer['name'];
        }

        if ($gameInSession->{"pos21"} == $secondPlayerId && $gameInSession->{"pos22"} == $secondPlayerId && $gameInSession->{"pos23"} == $secondPlayerId){
            $winner = $secondPlayer['name'];
        }

        if ($gameInSession->{"pos21"} == $firstPlayerId && $gameInSession->{"pos22"} == $firstPlayerId && $gameInSession->{"pos23"} == $firstPlayerId){
            $winner = $firstPlayer['name'];
        }

        if ($gameInSession->{"pos31"} == $secondPlayerId && $gameInSession->{"pos32"} == $secondPlayerId && $gameInSession->{"pos33"} == $secondPlayerId){
            $winner = $secondPlayer['name'];
        }

        if ($gameInSession->{"pos31"} == $firstPlayerId && $gameInSession->{"pos32"} == $firstPlayerId && $gameInSession->{"pos33"} == $firstPlayerId){
            $winner = $firstPlayer['name'];
        }

        if ($gameInSession->{"pos11"} == $secondPlayerId && $gameInSession->{"pos12"} == $secondPlayerId && $gameInSession->{"pos13"} == $secondPlayerId){
            $winner = $secondPlayer['name'];
        }

        if ($gameInSession->{"pos11"} == $firstPlayerId && $gameInSession->{"pos12"} == $firstPlayerId && $gameInSession->{"pos13"} == $firstPlayerId){
            $winner = $firstPlayer['name'];
        }

        if ($gameInSession->{"pos12"} == $secondPlayerId && $gameInSession->{"pos22"} == $secondPlayerId && $gameInSession->{"pos32"} == $secondPlayerId){
            $winner = $secondPlayer['name'];
        }

        if ($gameInSession->{"pos12"} == $firstPlayerId && $gameInSession->{"pos22"} == $firstPlayerId && $gameInSession->{"pos32"} == $firstPlayerId){
            $winner = $firstPlayer['name'];
        }

        if ($gameInSession->{"pos13"} == $secondPlayerId && $gameInSession->{"pos23"} == $secondPlayerId && $gameInSession->{"pos33"} == $secondPlayerId){
            $winner = $secondPlayer['name'];
        }

        if ($gameInSession->{"pos13"} == $firstPlayerId && $gameInSession->{"pos23"} == $firstPlayerId && $gameInSession->{"pos33"} == $firstPlayerId){
            $winner = $firstPlayer['name'];
        }

        if ($gameInSession->{"pos13"} == $secondPlayerId && $gameInSession->{"pos22"} == $secondPlayerId && $gameInSession->{"pos31"} == $secondPlayerId){
            $winner = $secondPlayer['name'];
        }

        if ($gameInSession->{"pos13"} == $firstPlayerId && $gameInSession->{"pos22"} == $firstPlayerId && $gameInSession->{"pos31"} == $firstPlayerId){
            $winner = $firstPlayer['name'];
        }

        if ($gameInSession->{"pos11"} == $secondPlayerId && $gameInSession->{"pos22"} == $secondPlayerId && $gameInSession->{"pos33"} == $secondPlayerId){
            $winner = $secondPlayer['name'];
        }

        if ($gameInSession->{"pos11"} == $firstPlayerId && $gameInSession->{"pos22"} == $firstPlayerId && $gameInSession->{"pos33"} == $firstPlayerId){
            $winner = $firstPlayer['name'];
        }

        return $winner;
    }
}
