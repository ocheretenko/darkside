<?php

class Globals
{
    public static function AskTemplatePart($name)
    {
        if (strpos($name, '.phtml') === false) $name .= '.phtml';

        if (!file_exists('template_parts' . DIRECTORY_SEPARATOR . $name)) return;

        $path = 'template_parts' . DIRECTORY_SEPARATOR . $name;

        require $path;
    }

    public static $pdo;

    public static function Init()
    {
        try {
            self::$pdo =
                new PDO('mysql:host='. DB_HOST .';dbname=' . DB_NAME,
                    DB_USER,
                    DB_PASSWORD);
        }
        catch (Exception $exception)
        {
            echo 'db error<br>';
        }
    }

    public static function AskCss($name)
    {
        if (strpos($name,'.css') === false)
            $name .= '.css';

        $name = '/static/styles/' .  $name;
        echo '<link rel="stylesheet" href="' .$name. '">';
    }
}

Globals::Init();