<?php
function ConnectToDatabase($servername, $username, $password){
    try{
        $conn = new PDO("mysql:host=$servername; dbname=museo", $username, $password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e){
        echo "<script>console.log(" . $e->getMessage() . ")</script>";
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        die("Connessione al database fallita. Riprovare.");
    }
}
?>