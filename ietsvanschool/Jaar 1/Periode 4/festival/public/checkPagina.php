<?php
$gebruikersnaam = $_POST["gebruikersnaam"];
$wachtwoord = $_POST["wachtwoord"];
if(!empty($_POST["gebruikersnaam"]) && !empty($_POST["wachtwoord"])){
?>

<h2><?php echo "Gebruikersnaam: $gebruikersnaam" ?></h2>
<h2><?php echo "Wachtwoord: $wachtwoord" ?></h2>

<form action="ticketsverkoop.php" method="post">
    <input type="submit" name="submit">
</form>
<?php } else {header("Location: index.php");
exit();}
