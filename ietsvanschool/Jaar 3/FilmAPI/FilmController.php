<?php
require_once "Film.php";
require_once "JWT.php";

function getFilms() {

    $films = array();
    $host = 'localhost';
    $dbuser = 'nhuijskes_dbuser';
    $dbpass = 'SterkWachtwoord';
    $dbname = 'nhuijskes_security';
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    
    $sql = 'SELECT * FROM films';
    $results = $conn->query($sql);


    foreach($results as $result){
        $film = new Film();
        $film->setid($result["id"]);
        $film->settitel($result["titel"]);
        $film->setspeelduur($result["speelduur"]);
        $film->setkijkwijzer($result["kijkwijzer"]);
        $film->setgenre($result["genre"]);
        array_push($films, $film);
    }


    $conn->close();

    return json_encode($films, JSON_PRETTY_PRINT);

}

function getFilmById($id) {
    
    $films = array();
    $host = 'localhost';
    $dbuser = 'nhuijskes_dbuser';
    $dbpass = 'SterkWachtwoord';
    $dbname = 'nhuijskes_security';
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    
    $sql = 'SELECT * FROM films WHERE id = "'.$id .'"';
    $results = $conn->query($sql);


    foreach($results as $result){
        $film = new Film();
        $film->setid($result["id"]);
        $film->settitel($result["titel"]);
        $film->setspeelduur($result["speelduur"]);
        $film->setkijkwijzer($result["kijkwijzer"]);
        $film->setgenre($result["genre"]);
        array_push($films, $film);
    }


    $conn->close();

    return json_encode($films, JSON_PRETTY_PRINT);
}

function addFilm(){
    
    $films = array();
    $host = 'localhost';
    $dbuser = 'nhuijskes_dbuser';
    $dbpass = 'SterkWachtwoord';
    $dbname = 'nhuijskes_security';
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    
    $urlInput = file_get_contents('php://input');
    $decodedInput = json_decode($urlInput);
    
    $sql = 'INSERT INTO `films`(`id`, `titel`, `speelduur`, `kijkwijzer`, `genre`) VALUES (NULL,"'.$decodedInput->titel.'","'.$decodedInput->speelduur.'","'.$decodedInput->kijkwijzer.'","'.$decodedInput->genre.'")';
    $results = $conn->query($sql);


    foreach($results as $result){
        $film = new Film();
        $film->setid($result["id"]);
        $film->settitel($result["titel"]);
        $film->setspeelduur($result["speelduur"]);
        $film->setkijkwijzer($result["kijkwijzer"]);
        $film->setgenre($result["genre"]);
        array_push($films, $film);
    }


    $conn->close();

    echo "De film is opgeslagen";

}

function deleteFilmById($id){
    
    $films = array();
    $host = 'localhost';
    $dbuser = 'nhuijskes_dbuser';
    $dbpass = 'SterkWachtwoord';
    $dbname = 'nhuijskes_security';
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}
    
    
    $sql = 'DELETE FROM films WHERE id = "'.$id .'"';
    $results = $conn->query($sql);


    foreach($results as $result){
        $film = new Film();
        $film->setid($result["id"]);
        $film->settitel($result["titel"]);
        $film->setspeelduur($result["speelduur"]);
        $film->setkijkwijzer($result["kijkwijzer"]);
        $film->setgenre($result["genre"]);
        array_push($films, $film);
    }$jwt = new JWT();


    $conn->close();

    echo "De film met het gegeven id is verwijderd";

}
$jwt = new JWT();
$token = $_SERVER["HTTP_AUTHORIZATION"];
$authlvl = json_decode($jwt->getPayloadFromToken($token));
if($jwt->verifyToken($token)){
    
    if ($_SERVER["REQUEST_METHOD"] == "GET" && $authlvl->authlvl == 0){
        echo "Je hebt onvoldoende rechten voor dit verzoek";
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $authlvl->authlvl > 0) {
        
    if (isset($_GET["id"])){
       print(getFilmById($_GET["id"]));
    } else {
        print(getFilms());
    }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $authlvl->authlvl <= 1) {
        echo "Je hebt onvoldoende rechten voor dit verzoek";
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $authlvl->authlvl > 1) {
        addFilm();
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE" && $authlvl->authlvl <= 2) {
        echo "Je hebt onvoldoende rechten voor dit verzoek";
    } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE" && $authlvl->authlvl > 2) {
        $urlInput = file_get_contents('php://input');
        $decodedInput = json_decode($urlInput);
        deleteFilmById($decodedInput->id);
    }

} else {
    echo "De token is niet geldig";
}
