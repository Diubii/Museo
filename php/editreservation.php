<?php
include('methods.php');

$reservationData = json_decode($_POST["reservationData"]);
$id = $reservationData->id;
$name = $reservationData->name;
$contact = $reservationData->contact;
$n_people = $reservationData->n_people;
$entrance_time = $reservationData->entrance_time;

if (isset($reservationData->username)) {
    $username = $reservationData->username;
}

if (isset($name) && isset($contact) && isset($entrance_time) && isset($n_people)) {
    $dbservername = "database.diubi.dev";
    $dbusername = "managermuseo";
    $dbpassword = "museokyoto";

    $conn = ConnectToDatabase($dbservername, $dbusername, $dbpassword);

    try{
        $binding = $conn -> query("SELECT SUM(n_people) 
        FROM reservation 
        WHERE DATE(entrance_time) = "."\"". date("Y-m-d", strtotime($entrance_time))."\"".
        " AND HOUR(entrance_time) = ".date("H", strtotime($entrance_time)).
        " AND MINUTE(entrance_time) BETWEEN 0 AND 59");

        while($row = $binding -> fetch()){
            $ex_n_people = $row["SUM(n_people)"];
            if($ex_n_people == 50){
                throw new Exception("Ci sono già $ex_n_people persone in quest'ora, scegliere un'altra data o ora.");
            }
            else if(($ex_n_people + $n_people) > 50){
                throw new Exception("La tua prenotazione sforerebbe il limite di 50 persone all'ora, diminuire il numero di visitatori.");
            }
        }
    }
    catch(Exception $e){
        header($_SERVER['SERVER_PROTOCOL'] . ' 502 ' . $e -> getMessage());
        die($e -> getMessage());
    }

    try{
        $binding = $conn -> prepare("SELECT entrance_time FROM reservation WHERE entrance_time = :entrance_time");
        $binding->bindParam(":entrance_time", $entrance_time, PDO::PARAM_STR);
        $binding->execute();

        if($binding->rowCount() == 1){
            throw new Exception("Una prenotazione a quest'ora esiste già");
        }
    }
    catch(Exception $e){
        header($_SERVER['SERVER_PROTOCOL'] . ' 501 ' . $e -> getMessage());
        die($e -> getMessage());
    }

    try {
        $binding = $conn->prepare("UPDATE reservation SET name = :name, contact = :contact, n_people = :n_people, entrance_time = :entrance_time WHERE id = :id");

        $binding->bindParam(":name", $name, PDO::PARAM_STR);
        $binding->bindParam(":contact", $contact, PDO::PARAM_STR);
        $binding->bindParam(":n_people", $n_people, PDO::PARAM_INT);
        $binding->bindParam(":entrance_time", $entrance_time, PDO::PARAM_STR);
        $binding->bindParam(":id", $id, PDO::PARAM_STR);
        $binding->execute();
    } catch (PDOException $e) {
        echo "<script>console.log(" . $e->getMessage() . ")</script>";
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        die("Errore durante l'inserimento dati nel database. Riprovare.");
    }

    echo json_encode("Success");
} else {
    try {
        throw new Exception("Inserire tutti i dati.");
    } catch (Exception $e) {
        header($_SERVER['SERVER_PROTOCOL'] . " 500 " . $e->getMessage());
        die($e->getMessage());
    }
}
