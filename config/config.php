<?php
    $folderPath = dirname($_SERVER["SCRIPT_NAME"]);
    $urlPath = $_SERVER["REQUEST_URI"];
    $url = substr($urlPath, strlen($folderPath) - 1);

    define('__URL__', $url);