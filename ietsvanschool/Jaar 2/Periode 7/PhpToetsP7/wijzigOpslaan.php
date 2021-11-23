<?php

require_once('databasecon.php');
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die;
}
//wijzigingen die je maakt opslaan
if ($_POST['type'] === 'S') {
    $query = $pdo->prepare("UPDATE `land` SET
                            `land` = :land,
                            `zanger` = :zanger,
                            `punten` = :punten
                            WHERE `id` = :id
                            ");
    $query->bindParam(':id', $_POST['id']);
    $query->bindParam(':land', $_POST['land']);
    $query->bindParam(':zanger', $_POST['zanger']);
    $query->bindParam(':punten', $_POST['punten']);
    $query->execute();
    header("Location: index.php");
}