<?php
require_once __DIR__."/../controllers/AuthController.php";
require_once __DIR__."/../controllers/ProductController.php";

$router->add("POST","/api/login",[AuthController::class,"login"]);
$router->add("GET","/api/products",[ProductController::class,"list"]);
$router->add("POST","/api/products",[ProductController::class,"create"]);