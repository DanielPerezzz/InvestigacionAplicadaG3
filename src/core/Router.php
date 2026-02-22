<?php
class Router {
    private $routes = [];

    public function add($method, $path, $handler) {
        $this->routes[] = [$method, $path, $handler];
    }

    public function dispatch($method, $uri) {
        foreach ($this->routes as $route) {
            if ($route[0] == $method && $route[1] == $uri) {
                return call_user_func($route[2]);
            }
        }
        Response::json(["error" => "Not Found"], 404);
    }
}