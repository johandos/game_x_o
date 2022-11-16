<?php

namespace App\Utils;

class View
{
    protected $data;

    function render($template, $data = null): bool|string
    {
        $this->assign($this->data, $data);
        ob_start();
        require __DIR__."/../views/" . $template . ".php";
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }


    function assign($key, $val): void
    {
        $this->data[$key] = $val;
    }
}