<?php
require_once __DIR__."/../src/core/Router.php";
require_once __DIR__."/../src/core/Response.php";

$router = new Router();

require_once __DIR__."/../src/routes/api.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);