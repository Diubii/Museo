<?php
include('methods.php');
$dbservername = "database.diubi.dev";
$dbusername = "managermuseo";
$dbpassword = "museokyoto";

$conn = ConnectToDatabase($dbservername, $dbusername, $dbpassword);

$idData = json_decode($_REQUEST["id"]);
$id = $idData -> id;

$query = "SELECT * FROM reservation WHERE id = '$id'";
$result = $conn->query($query);

$currentID = null;
if ($result->rowCount() > 0) {
    while ($row = $result->fetch()) {
        echo json_encode(array($row["id"], $row["name"], $row["n_people"], $row["entrance_time"], $row["contact"]));
    }
} else {
    echo json_encode(array("Nessuna prenotazione."));
}
?>