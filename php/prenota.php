<?php
if(isset($_REQUEST["n"]) && isset($_REQUEST["c"]) && isset($_REQUEST["e"]) && isset($_REQUEST["np"])){
    $servername="database.diubi.dev";
    $username="managermuseo";
    $password="museokyoto";
    
    try{
        $conn = new PDO("mysql:host=$servername; dbname=museo", $username, $password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "<script>console.log(" . $e->getMessage() . ")</script>";
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        die("Connessione al database fallita. Riprovare.");
    }
    
    $binding = $conn -> prepare("INSERT INTO reservation(name, contact, n_people, entrance_time) 
    VALUES(:r_name, :contact, :n_people, :entrance_time)");

    $binding -> bindParam(":r_name", $_REQUEST["n"], PDO::PARAM_STR);
    $binding -> bindParam(":contact", $_REQUEST["c"], PDO::PARAM_STR);
    $binding -> bindParam(":n_people", $_REQUEST["np"], PDO::PARAM_INT);
    $binding -> bindParam(":entrance_time", $_REQUEST["e"], PDO::PARAM_STR);
    echo "<script>console.log(" . $binding -> queryString . ")</script>";
    $binding -> execute();
}
else{
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
    die("Riempire tutti i campi. Riprovare.");
}
?>