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
}