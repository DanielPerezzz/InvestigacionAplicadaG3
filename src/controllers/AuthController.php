<?php
require_once __DIR__."/../core/Response.php";
require_once __DIR__."/../core/Request.php";
require_once __DIR__."/../core/JWT.php";

class AuthController {

    public static function login() {
        $data = Request::body();
        $users = json_decode(file_get_contents(__DIR__."/../data/users.json"), true);

        foreach($users as $user){
            if($user["username"] == $data["username"] && password_verify($data["password"], $user["password"])) {

                $token = JWT::generate(["id"=>$user["id"],"time"=>time()]);
                Response::json(["token"=>$token]);
            }
        }

        Response::json(["error"=>"Invalid credentials"],401);
    }
}