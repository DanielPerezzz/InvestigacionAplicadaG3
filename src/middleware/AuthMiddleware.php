<?php
require_once __DIR__."/../core/JWT.php";
require_once __DIR__."/../core/Response.php";

class AuthMiddleware {

    public static function check() {
        $headers = getallheaders();

        if(!isset($headers["Authorization"]))
            Response::json(["error"=>"No token"],403);

        $token = str_replace("Bearer ","",$headers["Authorization"]);
        $decoded = JWT::verify($token);

        if(!$decoded)
            Response::json(["error"=>"Unauthorized"],401);

        return $decoded;
    }
}