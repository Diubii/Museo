<?php
include('methods.php');

$reservationData = json_decode($_POST["reservationData"]);
$name = $reservationData->name;
$contact = $reservationData->contact;
$n_people = $reservationData->n_people;
$entrance_time = $reservationData->entrance_time;
if(isset($reservationData->username)){
$username = $reservationData->username;
}

if (isset($name) && isset($contact) && isset($entrance_time) && isset($n_people)) {
    $dbservername = "database.diubi.dev";
    $dbusername = "managermuseo";
    $dbpassword = "museokyoto";

    $conn = ConnectToDatabase($dbservername, $dbusername, $dbpassword);

    try {
        $binding = $conn->prepare("INSERT INTO reservation VALUES(:id, :r_name, :contact, :n_people, :entrance_time)");

        $id = GenerateID($conn);
        $binding->bindParam(":id", $id, PDO::PARAM_STR);
        $binding->bindParam(":r_name", $name, PDO::PARAM_STR);
        $binding->bindParam(":contact", $contact, PDO::PARAM_STR);
        $binding->bindParam(":n_people", $n_people, PDO::PARAM_INT);
        $binding->bindParam(":entrance_time", $entrance_time, PDO::PARAM_STR);
        $binding->execute();

        if (isset($username)) {
            $binding = $conn->prepare("INSERT INTO account_reservation VALUES(:username, :id)");

            $binding->bindParam(":username", $username, PDO::PARAM_STR);
            $binding->bindParam(":id", $id, PDO::PARAM_STR);
            $binding->execute();
        }
    } catch (PDOException $e) {
        echo "<script>console.log(" . $e->getMessage() . ")</script>";
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        die("Errore durante l'inserimento dati nel database. Riprovare.");
    }

    echo json_encode($id);
} else {
    try {
        throw new Exception("Inserire tutti i dati.");
    } catch (Exception $e) {
        header($_SERVER['SERVER_PROTOCOL'] . " 500 " . $e->getMessage());
        die($e->getMessage());
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
    } while ($binding->rowCount() != 0);

    return $id;
}
