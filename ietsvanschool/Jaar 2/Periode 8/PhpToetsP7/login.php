<?php

require_once('databasecon.php');
session_start();

//login & registratie forms
?>
<h1>Inlog Songfestival</h1>
<form method="post">
    <input type="text"name="username" placeholder="Username">
    <input type="text"name="password" placeholder="Password">
    <input type="text"name="email" placeholder="Email">
    <input type="submit" name="login" value="Login">
</form>
<h1>Registreren Songfestival</h1>
<form method="post">
    <input type="text"name="regUsername" placeholder="Username">
    <input type="text"name="regPassword" placeholder="Password">
    <input type="text"name="regEmail" placeholder="Email">
    <input type="submit" name="registreren" value="Registreren">
</form>
<?php
//deze code zorgt ervoor dat het inloggen & registreren werkt
if (isset($_POST['login'])) {
    $stmt = $pdo->prepare("SELECT * FROM `gebruikers` WHERE `gebruikersnaam` = :username AND `wachtwoord` = :password AND `email` = :email");
    echo "test";
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();

    $count = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($count == 1 && !empty($row)) {
        $_SESSION['loggedInUser'] = $row['id'];
        header('Location: index.php');
        die;
    } else {
        echo "Invalide gebruikersnaam/wachtwoord/email combinatie";
    }
}
if (isset($_POST['registreren'])) {
    $query = $pdo->prepare("INSERT INTO `gebruikers` (id, gebruikersnaam, wachtwoord, email) VALUES (
        NULL,
        :gebruikersnaam,
        :wachtwoord,
        :email
        )");
$query->bindParam(':gebruikersnaam', $_POST['regUsername']);
$query->bindParam(':wachtwoord', $_POST['regPassword']);
$query->bindParam(':email', $_POST['regEmail']);
$query->execute();
}

?>