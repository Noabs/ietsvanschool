<?php

require_once "JWT.php";

function addUser(){
    
    $films = array();
    $host = 'localhost';
    $dbuser = 'nhuijskes_dbuser';
    $dbpass = 'SterkWachtwoord';
    $dbname = 'nhuijskes_security';
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    
    $hash = password_hash("Word", PASSWORD_DEFAULT);
    
    $sql = 'INSERT INTO `users`(`id`, `username`, `password`, `profielfoto`, `authlvl`) VALUES (NULL,"Han","'.$hash.'","pf","3")';
    $results = $conn->query($sql);



    $conn->close();


}

function login(){
    
    $films = array();
    $host = 'localhost';
    $dbuser = 'nhuijskes_dbuser';
    $dbpass = 'SterkWachtwoord';
    $dbname = 'nhuijskes_security';
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
        
    $sql = 'SELECT * FROM users WHERE username = "'.$_SERVER["HTTP_USERNAME"].'";';
    $results = $conn->query($sql);
    $result = $results->fetch_assoc();

    if (password_verify($_SERVER["HTTP_PASSWORD"], $result["password"])) {
        
$id = $result["id"];
$user = $result["username"];
$authlvl = $result["authlvl"];

$jwt = new JWT();
echo $jwt->createToken($id,$user,$authlvl);

    } else {
        echo 'Invalid password.';
    }

    $conn->close();

}
login();