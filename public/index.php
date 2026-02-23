<?php
//Carga dependencias del núcleo
require_once __DIR__."/../src/core/Router.php";
require_once __DIR__."/../src/core/Response.php";

//Instancia el enrutador principal
$router = new Router();

//Carga las rutas de la aplicación
require_once __DIR__."/../src/routes/api.php";

//Extrae la ruta de la URL
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);