<?php
//carga del middleware de autenticación y clases de utilidad
require_once __DIR__."/../middleware/AuthMiddleware.php";
require_once __DIR__."/../core/Response.php";
require_once __DIR__."/../core/Request.php";

class ProductController {

    //Lista todos los productos, requiere autenticación
    public static function list() {
        //Verifica si el token JWT enviado en los headers es válido
        AuthMiddleware::check();

        //lee el catálogo de productos desde el archivo JSON
        $products = json_decode(file_get_contents(__DIR__."/../data/products.json"), true);
        Response::json($products);
    }

    //Crea un nuevo producto, requiere autenticación
    public static function create() {
        //validación de seguridad obligatoria antes de procesar
        AuthMiddleware::check();

        //Captura los datos del nuevo producto desde el cuerpo de la petición
        $data = Request::body();

        $file = __DIR__."/../data/products.json";
        $products = json_decode(file_get_contents($file), true);

        $data["id"] = count($products)+1;
        $products[] = $data;

        file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
        Response::json($data,201);
    }
}