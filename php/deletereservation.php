<?php
include('methods.php');
$dbservername = "database.diubi.dev";
$dbusername = "managermuseo";
$dbpassword = "museokyoto";

$conn = ConnectToDatabase($dbservername, $dbusername, $dbpassword);

$query = "DELETE FROM reservation WHERE id = '$_POST[id]'";
$result = $conn -> query($query);
echo json_encode("Success");
?>
