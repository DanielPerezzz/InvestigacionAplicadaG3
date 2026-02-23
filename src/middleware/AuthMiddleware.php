<?php

//Carga las clases necesarias para validar tokens y enviar respuestas de error
require_once __DIR__."/../core/JWT.php";
require_once __DIR__."/../core/Response.php";

class AuthMiddleware {

    //verifica la validez del token JWT enviado en los headers de la petición
    public static function check() {
        $headers = getallheaders();

        if(!isset($headers["Authorization"]))
            Response::json(["error"=>"No token"],403);

        $token = str_replace("Bearer ","",$headers["Authorization"]);
        $decoded = JWT::verify($token);

        if(!$decoded)
            Response::json(["error"=>"Unauthorized"],401);

        //Si todo está correcto, retorna los datos decodificados del token para su uso posterior en la aplicación
        return $decoded;
    }
}