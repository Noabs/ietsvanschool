<?php require_once("../private/initialize.php"); ?>
<?php require_once("../private/shared/header.php");
$naam = $_POST["naam"];
$aantal = $_POST["aantal"];
$typeTickets = $_POST["typeTickets"];

$sql = "INSERT INTO tickets (TicketID,naam,aantal,typeticket) VALUES (NULL, '{$_POST['naam']}','{$_POST['aantal']}','{$_POST['typeTickets']}')";
if (!$db->query($sql)) {
    exit("Error description " . $db->error);
} else {
    echo "De bestelling is gelukt";
}
?>
<table border="1">
    <tr>
        <td>Naam</td>
        <td><?php echo $naam ?></td>
    </tr>
    <tr>
        <td>Aantal</td>
        <td><?php echo $aantal ?></td>
    </tr>
    <tr>
        <td>Type tickets</td>
        <td><?php echo $typeTickets ?></td>
    </tr>
</table>
