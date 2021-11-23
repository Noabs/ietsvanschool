<?php require_once("../private/initialize.php"); ?>
<?php require_once("../private/shared/header.php"); ?>


<form action="bevestiging.php" method="post">
Naam: <br>
    <input type="text" name="naam" value=""> <br>
Aantal: <br>
    <input type="number" name="aantal" value=""> <br> <br>
Type tickets:
<select name="typeTickets">
    <option>Basic</option>
    <option>Premium</option>
    <option>VIP</option>
</select> <br> <br>
<input type="submit" name="verzenden" value="Verzenden">
</form>
