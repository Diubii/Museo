<?php
$data = json_decode($_POST["data"]);
$firstDay = $data->firstDay;
$lastDay = $data->lastDay;

include('methods.php');
$dbservername = "database.diubi.dev";
$dbusername = "managermuseo";
$dbpassword = "museokyoto";

$conn = ConnectToDatabase($dbservername, $dbusername, $dbpassword);

try {
    $binding = $conn->prepare("SELECT SUM(n_people), entrance_time FROM reservation WHERE entrance_time BETWEEN :firstDay AND :lastDay GROUP BY DATE(entrance_time);");
    $binding->bindParam(":firstDay", $firstDay);
    $binding->bindParam(":lastDay", $lastDay);
    $binding->execute();

    $affluence = array(0, 0, 0, 0, 0, 0, 0);
    $lastDate = null;
    while ($row = $binding->fetch()) {
        $index = intval(Date("w", strtotime($row["entrance_time"])));

        $affluence[$index] = intval($row["SUM(n_people)"]);
        $lastDate = Date("Y-m-d", strtotime($row["entrance_time"]));
    }

} catch (PDOException $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 ' . $e->getMessage());
    die($e->getMessage());
}

echo json_encode($affluence);
