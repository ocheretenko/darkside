<?php

class Router
{
    function __construct()
    {
        $_SERVER['ROUTER'] = $this;

        $routes = file_get_contents('config'. DIRECTORY_SEPARATOR .'routes.json');
        $routes = json_decode($routes)->routes;

        $request = $_SERVER['REQUEST_URI'];

        if ($routes->$request === NULL)
        {
            return;
        }

        //require 'templates' . DIRECTORY_SEPARATOR . $routes->$request;
        require 'templates' . DIRECTORY_SEPARATOR . 'login.phtml';
    }

    public function AskTemplatePart($name)
    {
        if (strpos($name, '.phtml') === false) $name .= '.phtml';

        $path = 'template_parts' . DIRECTORY_SEPARATOR . $name;

        echo $path;

        if (file_exists($path))
            require $path;

    }
}