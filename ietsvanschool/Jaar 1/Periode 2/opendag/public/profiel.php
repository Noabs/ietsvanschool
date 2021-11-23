<?php require_once('../private/initialize.php');

$sql = "SELECT * FROM vroegevogels WHERE voornaam = '{$_POST['voornaam']}'";
$result = mysqli_query($db, $sql);
$subject = mysqli_fetch_assoc($result);
$inlogcheck = "SELECT * FROM vroegevogels WHERE voornaam = '{$_POST['voornaam']}'";


?>
    <div class="table">
        <table border="1">

            <tr>
                <td>Inschrijfnummer</td>
                <td>Voornaam</td>
                <td>Achternaam</td>
                <td>Email</td>
                <td>info</td>
                <td>Vip</td>
                <td>Inschrijfdatum</td>
            </tr>
            <tr>
                <td><?php echo ($subject['Inschrijfnummer']); ?></td>
                <td><?php echo ($subject['Voornaam']); ?></td>
                <td><?php echo ($subject['Achternaam']); ?></td>
                <td><?php echo ($subject['Email']); ?></td>
                <td><?php echo ($subject["info"]); ?></td>
                <td><?php echo ($subject['Vip']); ?></td>
                <td><?php echo ($subject['Inschrijfdatum']); ?></td>
            </tr>

        </table>
    </div>
    <br>

<?php include(SHARED_PATH .'/footer.php'); ?>