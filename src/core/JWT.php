<?php
class JWT {
    //Llave secreta para firmar los tokens, en un entorno real debería ser más segura y almacenada de forma segura
    private static $secret = "supersecretkey";

    public static function generate($payload) {
        //Crear el header
        $header = base64_encode(json_encode(["alg"=>"HS256","typ"=>"JWT"]));
        //Crear el payload con los datos proporcionados
        $payload = base64_encode(json_encode($payload));

        //Creando la firma usando HMAC SHA256
        $signature = hash_hmac("sha256", "$header.$payload", self::$secret, true);
        $signature = base64_encode($signature);

        return "$header.$payload.$signature";
    }

    public static function verify($token) {
        $parts = explode(".", $token);
        if(count($parts) != 3) return false;

        $signature = base64_encode(hash_hmac("sha256", "$parts[0].$parts[1]", self::$secret, true));

        if($signature !== $parts[2]) return false;

        return json_decode(base64_decode($parts[1]), true);
    }
}