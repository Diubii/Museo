<?php
if(isset($_REQUEST["n"]) && isset($_REQUEST["c"]) && isset($_REQUEST["e"]) && isset($_REQUEST["np"])){
    $servername="localhost";
    $username="root";
    $password="";
    
    try{
        $conn = new PDO("mysql:host=$servername; dbname=museo", $username, $password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "<script>console.log(" . $e->getMessage() . ")</script>";
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        die("Connessione al database fallita. Riprovare.");
    }

    try{
    $binding = $conn -> prepare("INSERT INTO reservation VALUES(:id, :r_name, :contact, :n_people, :entrance_time)");

    $binding -> bindParam(":id", GenerateID(), PDO::PARAM_STR);
    $binding -> bindParam(":r_name", $_REQUEST["n"], PDO::PARAM_STR);
    $binding -> bindParam(":contact", $_REQUEST["c"], PDO::PARAM_STR);
    $binding -> bindParam(":n_people", $_REQUEST["np"], PDO::PARAM_INT);
    $binding -> bindParam(":entrance_time", $_REQUEST["e"], PDO::PARAM_STR);
    echo "<script>console.log(" . $binding -> queryString . ")</script>";
    $binding -> execute();
    }
    catch(PDOException $e){
        echo "<script>console.log(" . $e->getMessage() . ")</script>";
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        die("Errore durante l'inserimento dati nel database. Riprovare.");
    }
}
else{
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
    die("Riempire tutti i campi. Riprovare.");
}

function GenerateID(){
    $letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
    'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

    $numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

    return $letters[rand(0, $letters.count - 1)] + $letters[rand(0, $letters.count - 1)] + $letters[rand(0, $letters.count - 1)] + $numbers[rand(0, $numbers.count - 1)] + $numbers[rand(0, $numbers.count - 1)];
}
?>