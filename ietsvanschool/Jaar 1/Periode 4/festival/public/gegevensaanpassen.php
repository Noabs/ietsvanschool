<?php require_once('../private/initialize.php');
include(SHARED_PATH .'/header.php');

$id = $_POST['id'];
$voornaam = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$email = $_POST['email'];
$wachtwoord = $_POST['wachtwoord'];
?>
<form action="savegegevens.php" method="post">
    <input type="text" name="id" value="<?php echo $id ?>" hidden>
    <input type="text" name="voornaam" value="<?php echo $_POST['voornaam']?>">
    <br>
    <input type="text" name="achternaam" value="<?php echo $_POST['achternaam'] ?>">
    <br>
    <input type="text" name="email" value="<?php echo $_POST['email'] ?>" >
    <br>
    <input type="text" name="wachtwoord" value="<?php echo $_POST['wachtwoord'] ?>">
    <br>
    <input type="submit" name="submit" value="Aanpassen!" class="pfpbutton">
</form>
