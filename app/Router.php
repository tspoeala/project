<?php

namespace App;

use Exception;

class Router
{
    public $routes = [
        'GET' => [],
        'POST' => [],
        'DELETE' => []
    ];

    private $request;

    private function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function load($file, $request)
    {
        $router = new static($request);

        require $file;

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {

            return $this->callAction(
                ...explode(':', $this->routes[$requestType][$uri])
            );
        }
        throw new Exception('No route defines for the uri');
    }

    protected function callAction($controller, $action)
    {
        $controller = "Src\\Controllers\\{$controller}";
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            throw new Exception(get_class($controller) . " does not respond to the {$action} action");
        }

        return $controller->$action($this->request);
    }
}
