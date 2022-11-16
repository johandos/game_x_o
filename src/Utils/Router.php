<?php

namespace App\Utils;

class Router
{
    private $controller;
    private $method;

    public function __construct()
    {
        $this->matchRoute();
    }

    public function matchRoute(): void
    {
        $url = explode("/", __URL__);
        $this->controller = !empty($url[1]) ? camelCase($url[1]) : 'Base';
        if (isset($url[2])){
            $this->method = explode("?", $url[2]);
        }
        $this->method = !empty($this->method[0]) ? camelCase($this->method[0]) : 'index';
        $this->controller = "{$this->controller}Controller";
    }

    public function run(): void
    {
        $namespace = "App\Controllers\\$this->controller";
        $controller = new $namespace();
        $method = $this->method;
        $controller->$method();
    }
}