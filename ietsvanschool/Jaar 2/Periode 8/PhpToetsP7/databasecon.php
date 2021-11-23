<?php

//dit bestand is om voor databse connectie maken zodat je dat niet in elk andere bestand opnieuw hoeft te doen

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "songfestival";
$charset = "utf8mb4";

try {
    $dsn = "mysql:host=" . $servername . ";dbname=" . $dbname . ";charset=" . $charset;
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOexception $e) {
    echo "Connection Failed: " . $e->getMessage();
}
