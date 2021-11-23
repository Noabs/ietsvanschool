<?php require_once('../private/initialize.php');
include(SHARED_PATH .'/header.php');

if (!empty($_POST)) {
    if ($_POST['formulier'] == "inloggen") {
        $sql = "SELECT * FROM klanten WHERE voornaam= '{$_POST['gebruikersnaam']}' AND wachtwoord='{$_POST['wachtwoord']}' ";
        if (!$db->query($sql)) {
            exit("Error description " . $db->error);
        } else {
            $resultaat = mysqli_query($db, $sql);
            $klant = mysqli_fetch_assoc($resultaat);
            if (mysqli_num_rows($resultaat) != 0) {
                header("Location: profiel.php?voornaam",$klant['voornaam']);
            } else {
                echo "Inloggegevens zijn onjuist";
            }
        }
    }
    if ($_POST['formulier'] == "registreren") {
        $sql = "INSERT INTO klanten (KlantID,voornaam,achternaam,email,wachtwoord) VALUES (NULL, '{$_POST['voornaamreg']}','{$_POST['achternaamreg']}','{$_POST['emailreg']}','{$_POST['wachtwoordreg']}')";
        if (!$db->query($sql)) {
            exit("Error description " . $db->error);
        } else {
            echo "Het registreren is gelukt";
        }
    }
}
if(!empty($_POST)) {
    $naam = $_POST['gebruikersnaam'];
    $pass = $_POST['wachtwoord'];

    $sql = "SELECT * FROM klanten WHERE Voornaam = '$naam' AND Wachtwoord = '$pass'";
    $result = mysqli_query($db , $sql);
    $klant = mysqli_fetch_assoc($result);

    if($naam == $klant['Voornaam'] && $pass == $klant['Wachtwoord']) {
        session_start();
        $_SESSION['id'] = $klant['KlantId'];
        $_SESSION['username'] = $klant['Voornaam'];
        $_SESSION['email'] = $klant['Email'];
        $_SESSION['password'] = $klant['Wachtwoord'];

        header("Location: profiel.php");
        exit();
    }
}
?>

<div id="inloggen">

    <h2> Inloggen </h2>

    <form action="profiel.php" method="post">
        <input type="hidden" name="formulier" value="inloggen">
        Voornaam:<br>
        <input type="text" name="gebruikersnaam">
        <br>
        Wachtwoord:<br>
        <input type="password" name="wachtwoord">
        <br>
        <br>
        <input type="submit" name="Submit">
    </form>
</div>

<div id="registratie">

    <h2 id="registratieh2"> Registratie </h2>

    <form action="" method="post">
        <input type="hidden" name="formulier" value="registreren">
        Voornaam:<br>
        <input type="text" name="voornaamreg">
        <br>
        Achternaam:<br>
        <input type="text" name="achternaamreg">
        <br>
        Email:<br>
        <input type="text" name="emailreg">
        <br>
        Wachtwoord:<br>
        <input type="password" name="wachtwoordreg">
        <br>
        <br>
        <input type="submit" name="submit">
    </form>
</div>

<?php include(SHARED_PATH .'/footer.php'); ?>


