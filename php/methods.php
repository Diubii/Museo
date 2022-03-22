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


function GenerateID($conn)
{
    $letters = array(
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
    );

    $numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

    do {
        $id = $letters[rand(0, count($letters) - 1)] . $letters[rand(0, count($letters) - 1)] . $numbers[rand(0, count($numbers) - 1)] . $numbers[rand(0, count($numbers) - 1)] . $numbers[rand(0, count($numbers) - 1)];
        $binding = $conn->prepare("SELECT id FROM reservation WHERE id=:id");
        $binding->bindParam(":id", $id, PDO::PARAM_STR);
        $binding->execute();
    } while ($binding->rowCount() == 1);

    return $id;
}
?>