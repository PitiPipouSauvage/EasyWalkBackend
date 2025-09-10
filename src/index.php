<?php

require_once "core/Router.php";
require_once "core/Controller.php";

$router = new Router();

require_once "routes/api.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$router->dispatch($uri, $method);
