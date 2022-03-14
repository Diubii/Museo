<?php
$servername="database.diubi.dev";
$username="managermuseo";
$password="museokyoto";

try{
    $conn = new PDO("mysql:host=$servername; dbname=museo", $username, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "<script>console.log(" . '"' . $e->getMessage() . '"'. ")</script>";
    die("Connessione al database fallita. Riprovare.");
}

$query = "SELECT name, n_people, entrance_time, contact FROM reservation";
$result = $conn -> query($query);

if($result->rowCount() > 0){
    while($row = $result -> fetch()){
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["n_people"] . "</td><td>" . $row["entrance_time"] . "</td><td>" . $row["contact"] . "</td></tr>";
    }
}
else{
    echo "<tr><td>" . "Nessuna prenotazione." . "</td></tr>";
}
?>