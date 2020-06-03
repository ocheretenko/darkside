<?php

class Router
{
    function __construct()
    {
        $_SERVER['ROUTER'] = $this;

        $routes = file_get_contents('config'. DIRECTORY_SEPARATOR .'routes.json');
        $routes = json_decode($routes)->routes;

        $request = $_SERVER['REQUEST_URI'];

        //cut GET part of request //?get=xx
        if (strpos($request, '?') !== false)
            $request = substr($request,0, strpos($request, '?'));

        if ($routes->$request === NULL)     //no such route
        {
            $request = '/404';
        }

        $request = $routes->$request;

        $request = $this->FileExtension($request);

        if ($this->TemplateExists($request))
        {
            require 'templates' . DIRECTORY_SEPARATOR . $request;
        }
    }

    public function FileExtension($file)
    {
        if (strpos($file, '.phtml') === false)
        {
            return ($file . '.phtml');
        }

        return $file;
    }



    public function TemplateExists($name)
    {
        return file_exists( 'templates' . DIRECTORY_SEPARATOR . $name)
            || file_exists('template_parts' . DIRECTORY_SEPARATOR . $name);
    }
}