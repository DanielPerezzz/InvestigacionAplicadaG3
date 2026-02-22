<?php
require_once __DIR__."/../middleware/AuthMiddleware.php";
require_once __DIR__."/../core/Response.php";
require_once __DIR__."/../core/Request.php";

class ProductController {

    public static function list() {
        AuthMiddleware::check();
        $products = json_decode(file_get_contents(__DIR__."/../data/products.json"), true);
        Response::json($products);
    }

    public static function create() {
        AuthMiddleware::check();
        $data = Request::body();

        $file = __DIR__."/../data/products.json";
        $products = json_decode(file_get_contents($file), true);

        $data["id"] = count($products)+1;
        $products[] = $data;

        file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
        Response::json($data,201);
    }
}