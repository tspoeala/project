<?php

namespace App;

class Request
{
    private $post;
    private $get;
    private $session;
    private $server;
    private $files;


    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function createFromGlobals()
    {
        session_start();
        $this->post = $_POST;
        $this->get = $_GET;
        $this->session = &$_SESSION;
        $this->server = $_SERVER;
        $this->files = $_FILES;
    }

    public function giveTheQuery()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), '/');
    }

    public function getQuery()
    {
        return $this->get;
    }

    public function getFormData()
    {
        return $this->post;
    }

    public function getFilesData($photo = null)
    {
        if (null == $photo) {
            return $this->files;
        }
        return $this->files[$photo];
    }

    public function removeFromSession($key)
    {
        unset($this->session[$key]);
    }

    public function writeToSession($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function keyExistsInSession($key)
    {
        return isset($this->session[$key]);
    }

    public function getServer()
    {
        return $this->server;
    }
}