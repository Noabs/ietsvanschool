<?php

session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die;
}
//Hier kan je een nieuw land toevoegen aan de database
if ($_GET['type'] === 'S') { ?>
<a href="index.php?">Terug</a>
<table>
    <form action="addentry.php" method="post">
        <input type="hidden" name="type" value="S">
        <tr>
            <td><b>Land</b></td>
            <td> <input type="text" name="land"> </td>
        </tr>
        <tr>
            <td><b>Zanger</b></td>
            <td> <input type="text" name="zanger"> </td>
        </tr>
        <tr>
            <td><input type="submit" name="landToevoegen" value="Aanmaken"></td>
        </tr>
    </form>
</table>
<?php
}