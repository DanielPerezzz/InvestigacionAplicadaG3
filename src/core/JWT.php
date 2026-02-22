<?php
class JWT {

    private static $secret = "supersecretkey";

    public static function generate($payload) {
        $header = base64_encode(json_encode(["alg"=>"HS256","typ"=>"JWT"]));
        $payload = base64_encode(json_encode($payload));

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