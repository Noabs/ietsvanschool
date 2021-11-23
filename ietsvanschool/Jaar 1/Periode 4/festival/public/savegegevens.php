<?php require_once('../private/initialize.php');
include(SHARED_PATH .'/header.php');

$id = $_POST['id'];
$voornaam = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$email = $_POST['email'];
$wachtwoord = $_POST['wachtwoord'];



$sql = "UPDATE `klanten` SET `KlantID` = {$id}, `Voornaam` = '{$voornaam}', `Achternaam` = '{$achternaam}', `Email` = '{$email}', `Wachtwoord` = '{$wachtwoord}' WHERE KlantID = '{$id}'";
if(!$db->query($sql)) {
    exit("Error description " . $db->error);
}
mysqli_query($db, $sql);
?>
<h2> Uw gegevens zijn aangepast!</h2>
<form action="profiel.php">
    <input type="submit" value="Naar profiel" id="pfpbutton">
</form>
