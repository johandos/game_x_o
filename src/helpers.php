<?php
    
    use App\Utils\Session;
    
    if (!function_exists('camelCase')){
    function camelCase($string): string
    {
        return ucfirst($string);
    }
}

if (!function_exists('showPositions')){
    function showPositions($positionToShow, $positionValue): string
    {
        $session = new Session();
        $firstPlayer = $session->getAttribute('firstPlayer');
        $secondPlayer = $session->getAttribute('secondPlayer');
        
        return match ((int)$positionValue) {
            $firstPlayer => "<img width='20px' src=\"../public/img/o.jpg\"  alt='' />",
            $secondPlayer => "<img width='20px' src=\"../public/img/x.jpg\"  alt='' />",
            default => "<a href=\"/game/savePosition?position=" . $positionToShow . "\"><img width='20px' src=\"../public/img/default.png\"  alt='defaultImg' /></a>",
        };
    }
}