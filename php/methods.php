<?php

use LDAP\Result;

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

function ConnectToDefaultDatabase(){
    try{
        $conn = new PDO("mysql:host=database.diubi.dev; dbname=museo", "managermuseo", "museokyoto");
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $e){
        echo "<script>console.log(" . $e->getMessage() . ")</script>";
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        die("Connessione al database fallita. Riprovare.");
    }
}

function GetValue($table, $column, $whereclause){
    $conn = ConnectToDefaultDatabase();

    $query = "SELECT $column FROM $table $whereclause";
    $result = $conn -> query($query);
    while($row = $result -> fetch()){
        return $row[$column];
    }
}
?>