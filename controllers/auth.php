<?php
namespace Controllers;
use \Firebase\JWT\JWT;
use \Models\User;

class AuthController {

    public static function login($request) {
        $user = User::find($request);
        if($user == false) {
            http_response_code(401);
            echo json_encode(array("error" => "Login failed", "error_description"=>"User Not Found."));
            return;
        }
        if($user->active == 'No') {
            http_response_code(401);
            echo json_encode(array("error" => "Login failed", "error_description"=>"No Active."));
            return;
        }
        $user->last_access = date("Y-m-d");
        $user->save();
        $token = array(
            "iss" => ISS,
            "aud" => AUD,
            "iat" => IAT,
            "nbf" => NBF,
            "data" => $user
        );
            
        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($token, SECURITE_KEY);
        //$decoded = JWT::decode($jwt, $key, array('HS256'));
    
        // print_r($decoded);
            
        echo json_encode(
            array(
                    "message" => "Successful login.",
                    "token" => $jwt
                    )
            );
        
    }

    

}