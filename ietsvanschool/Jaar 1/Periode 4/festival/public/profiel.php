<?php require_once('../private/initialize.php');
include(SHARED_PATH .'/header.php');

$sql = "SELECT * FROM klanten WHERE voornaam = '{$_POST['gebruikersnaam']}' AND wachtwoord = '{$_POST['wachtwoord']}'";
$result = mysqli_query($db, $sql);
$subject = mysqli_fetch_assoc($result);
$inlogcheck = "SELECT * FROM klanten WHERE voornaam = '{$_POST['gebruikersnaam']}' AND wachtwoord = '{$_POST['wachtwoord']}'";
$id = $subject['KlantID'];

$wachtwoord = $subject["Wachtwoord"];
$voornaam = $subject["Voornaam"];
$achternaam = $subject["Achternaam"];
$email = $subject["Email"];

if(empty($subject)){
    header("Location: index.php");
}
session_start();
if (!empty($_SESSION)) {
    $naam = $_SESSION['username'];
    $pass = $_SESSION['password'];

    $sql = "SELECT * FROM klanten WHERE Voornaam = '$naam' AND Wachtwoord = '$pass'";
    $result = mysqli_query($db, $sql);
    $klant = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
}
?>
    <div class="table">
        <table border="1">

        <tr>
            <td>Voornaam</td>
            <td><?php echo ($subject['Voornaam']); ?></td>
        </tr>
        <tr>
            <td>Achternaam</td>
            <td><?php echo ($subject['Achternaam']); ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $subject['Email']; ?></td>
        </tr>
        <tr>
            <td>Wachtwoord</td>
            <td><?php echo ($subject["Wachtwoord"]); ?></td>
        </tr>

        </table>
    </div>
<br>
    <form action="ticketsverkoop.php">
        <input type="submit">
    </form>

    <form action="gegevensaanpassen.php" method="post">

        <input type="text" name="id" value="<?php echo $subject['KlantID']; ?>" hidden>
        <input type="text" name="voornaam" value="<?php echo $voornaam ?>" hidden>
        <input type="text" name="achternaam" value="<?php echo $achternaam ?>" hidden>
        <input type="text" name="email" value="<?php echo $email ?>" hidden>
        <input type="password" name="wachtwoord" value="<?php echo $wachtwoord ?>" hidden>

        <input type="submit" id="submit" value="Gegevens aanpassen!" class="pfpbutton">
    </form>

<?php include(SHARED_PATH .'/footer.php'); ?>