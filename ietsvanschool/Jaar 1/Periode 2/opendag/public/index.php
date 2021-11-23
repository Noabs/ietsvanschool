<?php require_once('../private/initialize.php');


if (!empty($_POST)) {
    if ($_POST['formulier'] == "inschrijven") {
        $sql = "INSERT INTO vroegevogels (inschrijvnummer,voornaam,achternaam,email,info,vip,inschrijfdatum) VALUES (NULL, '{$_POST['voornaam']}','{$_POST['achternaam']}','{$_POST['email']}','{$_POST['info']}','{$_POST['vip']}','{$_POST['inschrijfdatum']}')";
        if (!$db->query($sql)) {
            exit("Error description " . $db->error);
        } else {
            echo "Welkom '{$_POST['voornaam']}','{$_POST['achternaam']}'<br> Uw Voorinschrijving is verwerkt <br> U krijgt info toegestuurd";
        }
    }
}
?>
<div id="inschrijven">

    <form action="profiel.php" method="post">
        <input type="hidden" name="formulier" value="inschrijven">
        Voornaam :
        <input type="text" name="voornaam">
        <br>
        Achternaam :
        <input type="text" name="achternaam">
        <br>
       E-mail adres:
        <input type="email" name="email">
        <br>
        Wens info via de mail:
        <input type="radio" name="info" value="ja" checked>Ja
        <input type="radio" name="info" value="nee">Nee
        <br>
        <?php
        $vipNummer = rand(1,10);
        if($vipNummer == 7){

        } ?>
        <input type="submit" name="Submit" value="Inschrijven">
    </form>
</div>

<?php include(SHARED_PATH .'/footer.php'); ?>
