<?php
//hier linken we het bestand met de database conectie
require_once('databasecon.php');
session_start();
//check of de gebruiker is ingelogd
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    die;
}

$land     = isset($_GET['land']) && !empty($_GET['land'])  ? 'land=' . $_GET['land'] . '&'     : '';

$get_land = isset($_GET['land']) && !empty($_GET['land']) ? $_GET['land'] : 'id';

$landen = $pdo->query("SELECT * FROM land ORDER BY $get_land DESC");

?>
<body>
    <h1>Welkom op de site van het Songfestival</h1>

    <table>
        <th>
            <h4>Land</h4>
        </th>
        <th>
            <h4>Zanger</h4>
        </th>
        <th>
            <h4>Punten</h4>
        </th>
    <a href="landToevoegen.php?type=S">Land toevoegen</a>
        <?php
        //foreach loop om alle landen, zangers, punten onder elkaar te zetten met elke een eigen stem & wijzig knop
        foreach ($landen as $row) {
            echo '<tr>';
            echo '<td>', $row['land'] . '</td>';
            echo '<td>', $row['zanger'] . '</td>';
            echo '<td>', $row['punten'] . '</td>';
            echo '<td>' ?> <input type="submit" name="vote" value="Stem"> <?php '</td>';
            echo '<td><a href="wijzigPagina.php?id=' . $row['id'] . '">Wijzig pagina</a></td>';
            echo '</tr>';
        }
        if (isset($_POST['vote'])) {
            $query = $pdo->prepare("UPDATE `land` SET
                            `land` = :land,
                            `zanger` = :zanger,
                            `punten` = :punten
                            WHERE `id` = :id
                            ");
    $query->bindParam(':id', $_POST['id']);
    $query->bindParam(':land', $_POST['land']);
    $query->bindParam(':zanger', $_POST['zanger']);
    $query->bindParam(':punten', $_POST['punten']+1);
    $query->execute();
    header("Location: index.php");
        }
        ?>
    </table>
</body>