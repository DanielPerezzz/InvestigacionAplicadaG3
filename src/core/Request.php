<?php
class Request {
    public static function body() {
        return json_decode(file_get_contents("php://input"), true);
    }

    public static function headers() {
        return getallheaders();
    }
}