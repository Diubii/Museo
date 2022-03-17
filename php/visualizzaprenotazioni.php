<?php
include('methods.php');
$dbservername = "database.diubi.dev";
$dbusername = "managermuseo";
$dbpassword = "museokyoto";

$conn = ConnectToDatabase($dbservername, $dbusername, $dbpassword);

$query = "SELECT name, n_people, entrance_time, contact FROM reservation";
$result = $conn->query($query);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch()) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["n_people"] . "</td><td>" . $row["entrance_time"] . "</td><td>" . $row["contact"] . "</td></tr>";
    }
} else {
    echo "<tr><td>" . "Nessuna prenotazione." . "</td></tr>";
}
