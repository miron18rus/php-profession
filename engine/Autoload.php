<?php


class Autoload
{

    public function loadClass($className)
    {
        $filename = "../{$className}.php";
        $filename = str_replace(['app', "\\"], '/', $filename);
        $filename = str_replace("///", '/', $filename);
        /* var_dump($filename); */
        if (file_exists($filename)) {

            include $filename;
        };
    }
}
