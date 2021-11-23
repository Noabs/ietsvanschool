<?php

require_once('databasecon.php');
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die;
}
//hier kun je landen, zangers & punten wijzigen
$landen = $pdo->query("SELECT * FROM land WHERE id=" . $_GET['id']);
    $result = $landen->fetch();
?>
    <a href="index.php?">Terug</a>
    <table>
        <form action="wijzigOpslaan.php?id=<?= $_GET['id'] ?>" method="post">
            <input type="hidden" name="type" value="S">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <tr>
                <td><b>Land</b></td>
                <td> <input type="text" name="land" value="<?= $result['land'] ?>"> </td>
            </tr>
            <tr>
                <td><b>Zanger</b></td>
                <td> <input type="text" name="zanger" value="<?= $result['zanger'] ?>"> </td>
            </tr>
            <tr>
                <td><b>Punten</b></td>
                <td> <input type="number" min="1" name="punten" value="<?= $result['punten'] ?>"> </td>
            </tr>
            <tr>
                <td><input type="submit" name="wijzigen" value="Wijzig"></td>
            </tr>
        </form>
    </table>