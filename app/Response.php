<?php

namespace App;

class Response
{


    public static function view($name, $data = [])
    {
        extract($data);
        return require "src/Resources/views/{$name}.view.php";
    }

    public function redirect($path = null)
    {
        header("Location: /iMAG/{$path}");
        exit;
    }
}