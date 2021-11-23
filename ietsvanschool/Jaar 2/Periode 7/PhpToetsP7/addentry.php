<?php

require_once('databasecon.php');
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die;
}
//deze code zorgt ervoor dat je nieuwe landen & zangers kan toevoegen aan de database
if (isset($_POST) && !empty($_POST)) {
    if ($_POST['type'] === 'S') {
        $query = $pdo->prepare("INSERT INTO `land` (id, punten, land, zanger) VALUES (
                        NULL,
                        0,
                        :land,
                        :zanger
                        )");
        $query->bindParam(':land', $_POST['land']);
        $query->bindParam(':zanger', $_POST['zanger']);
        $query->execute();
        header("Location: index.php");
        }
    }
