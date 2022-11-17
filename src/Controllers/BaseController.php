<?php

namespace App\Controllers;

use App\Utils\View;
use App\Utils\Session;

class BaseController extends View
{
    public function index(): void
    {
        if (Session::statusSession() != PHP_SESSION_NONE){
            Session::destroySession();
        }
        
        echo View::render('base/index');
    }
}