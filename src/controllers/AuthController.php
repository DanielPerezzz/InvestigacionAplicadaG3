<?php
require_once __DIR__."/../core/Response.php";
require_once __DIR__."/../core/Request.php";
require_once __DIR__."/../core/JWT.php";

class AuthController {

    public static function login() {
        //Obtenemos los datos del cuerpo de la petición
        $data = Request::body();
        //Cargamos los usuarios desde el archivo JSON
        $users = json_decode(file_get_contents(__DIR__."/../data/users.json"), true);

        //Verificamos las credenciales
        foreach($users as $user){
            if($user["username"] == $data["username"] && password_verify($data["password"], $user["password"])) {

                //Generamos un token JWT con el ID del usuario y el tiempo actual
                $token = JWT::generate(["id"=>$user["id"],"time"=>time()]);

                //Devolvemos el token en la respuesta
                Response::json(["token"=>$token]);
            }
        }

        //Si no se encontraron coincidencias, devolvemos un error de autenticación
        Response::json(["error"=>"Invalid credentials"],401);
    }
}