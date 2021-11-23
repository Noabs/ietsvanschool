<?php
class JWT{
function createToken($userID, $username, $authlvl){
    //De header is een JSON met wat informatie over dit token
    $header = '{ "typ": "JWT", "alg": "HS256" }';
    $header = base64_encode($header);              //De header moet worden omgezet naar base64(URL) string om bruikbaar te kunnen zijn
    $header = str_replace("=", "", $header);       //De base64 naar base64URL --> dus = tekens verwijderen
    $header = str_replace("+", "-", $header);      //De base64 naar base64URL --> dus + tekens vervangen voor - tekens
    $header = str_replace("/", "_", $header);      //De base64 naar base64URL --> dus / tekens vervangen voor _ tekens

    //De payload is een JSON met data die vaak specifieke info over de user bevat
    $payload = '{ "iat": "'.date("Y-m-d H:i:s") .'", "userID": '.$userID.', "username": "'.$username.'", "authlvl": '.$authlvl.' }';
    $payload = base64_encode($payload);
    $payload = str_replace("=", "", $payload);
    $payload = str_replace("+", "-", $payload);
    $payload = str_replace("/", "_", $payload);

    //De signature wordt op een speciale manier gehashed
    //Feef het algoritme mee, dan de header.payload, dan nog secretkey en als laatst binary op true
    $signature = hash_hmac("sha256", $header.".".$payload, "qwerty1234", true);
    $signature = base64_encode($signature);
    $signature = str_replace("=", "", $signature);
    $signature = str_replace("+", "-", $signature);
    $signature = str_replace("/", "_", $signature);

    $jwt = $header.".".$payload.".".$signature;  //De hele jwt bestaat uit de header.payload.signature
    $token = "Bearer ".$jwt;                     //En dit is het gehele mee te sturen token voor een gebruiker

    return $token;
}

function verifyToken($token){
    $jwt = explode("Bearer ", $token)[1];
    $header = explode(".", $jwt)[0];
    $payload = explode(".", $jwt)[1];
    $signature = explode(".", $jwt)[2];

    //hard check signature
    //gebruik de header.payload van ontvangen JWT om te controleren of die nog overeenkomt met de signature
    //is dat anders dan is de inhoud veranderd en is het token niet meer geldig
    $checkSignature = hash_hmac("sha256", $header.".".$payload, "qwerty1234", true);
    $checkSignature = base64_encode($checkSignature);
    $checkSignature = str_replace("=", "", $checkSignature);
    $checkSignature = str_replace("+", "-", $checkSignature);
    $checkSignature = str_replace("/", "_", $checkSignature);

    if ($signature == $checkSignature) {
        return true;
    } else {
        return false;
    }
}

function getPayloadFromToken($token){
    
    $jwt = explode("Bearer ", $token)[1];
    $header = explode(".", $jwt)[0];
    $payload = explode(".", $jwt)[1];
    $signature = explode(".", $jwt)[2];

    return base64_decode($payload);
}

}