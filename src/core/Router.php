<?php
class Router {
    private $routes = [];

    //Almacena una nueva ruta con su método HTTP, path y handler asociado
    public function add($method, $path, $handler) {
        $this->routes[] = [$method, $path, $handler];
    }

    public function dispatch($method, $uri) {
        foreach ($this->routes as $route) {
            if ($route[0] == $method && $route[1] == $uri) {
                return call_user_func($route[2]);
            }
        }
        // Si no se encuentra una ruta coincidente, devuelve un error 404
        Response::json(["error" => "Not Found"], 404);
    }
}