<?php

use App\Router as Router;
use App\Request as Request;

require "vendor/autoload.php";


$request = new \App\Request();
$request->createFromGlobals();

$kernel = new \App\Kernel();
$kernel->handle($request);










