<?php

namespace App\Utils;

class View
{
    public static function render(string $template, array $data = []): bool|string
    {
        extract($data);
        ob_start();
        require __DIR__."/../views/" . $template . ".php";
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}