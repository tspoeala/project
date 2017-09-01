<?php

namespace App;

use App\Database\DbConnection;
use Src\Repository\CharacteristicsRepository;
use Src\Repository\ProductCharacteristicsRepository;
use Src\Repository\ProductRepository;
use Src\Repository\UserRepository;


class Kernel
{
    public $connection;

    public function __construct()
    {
        $this->registerConfig();
        $this->connection = DbConnection::make(AppContainer::get('config')['database']);
        $this->registerServices();
    }

    public function registerConfig()
    {
        AppContainer::bind('config', require 'config/config.php');
    }

    public function registerServices()
    {
        AppContainer::bind('userRepository', new UserRepository($this->connection));
        AppContainer::bind('productRepository', new ProductRepository($this->connection));
        AppContainer::bind('characteristicsRepository', new CharacteristicsRepository($this->connection));
        AppContainer::bind('productCharacteristicsRepository', new ProductCharacteristicsRepository($this->connection));
    }


    public function handle(Request $request)
    {
        $router = Router::load('app/config/routes.php', $request);

        $response = $router->direct(Request::uri(), Request::method());

        return $response;
    }
}
