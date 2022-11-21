<?php

namespace App\Exceptions;

use App\Utils\View;
use Exception;

class NotFoundGameException extends Exception
{
    public function getViewError()
    {
        View::render('errors/notFoundGame');
    }
}