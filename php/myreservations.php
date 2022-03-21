<?php
include('methods.php');
$dbservername = "database.diubi.dev";
$dbusername = "managermuseo";
$dbpassword = "museokyoto";

$conn = ConnectToDatabase($dbservername, $dbusername, $dbpassword);

$username = $_SESSION["username"];

$query = "SELECT reservation.id, reservation.name, reservation.n_people, reservation.entrance_time, reservation.contact FROM account_reservation LEFT JOIN reservation ON account_reservation.id = reservation.id";
$result = $conn->query($query);

$currentID = null;
if ($result->rowCount() > 0) {
    while ($row = $result->fetch()) {
        echo "<tr id=$row[id]><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["n_people"] . "</td><td>" . $row["entrance_time"] . "</td><td>" . $row["contact"] . "</td><td><a onclick=\"ShowEditReservation('$row[id]', document.getElementById('container'), document.getElementById('form'));\"><i class=\"fa-solid fa-pen-to-square\"></i></td><td><a onclick=\"DeleteReservation('$row[id]', '$_SERVER[PHP_SELF]');\"><i class=\"fa-solid fa-trash\"></i></a></td></tr>";
    }
} else {
    echo "<tr><td>" . "Nessuna prenotazione." . "</td></tr>";
}
