<?php
include('methods.php');

$signupData = json_decode($_POST["signupData"]);
$name = $signupData->name;
$username = $signupData->username;
$password = $signupData->password;

if (isset($name) && isset($username) && isset($password)) {
    $dbservername = "database.diubi.dev";
    $dbusername = "managermuseo";
    $dbpassword = "museokyoto";

    $conn = ConnectToDatabase($dbservername, $dbusername, $dbpassword);

    $dt = date("Y-m-d H:i:s");
    $role = "Visitatore del museo";

    try {
        $binding = $conn->prepare("SELECT username FROM account WHERE username = :username");
        $binding->bindParam(":username", $username, PDO::PARAM_STR);
        $binding->execute();

        if ($binding->rowCount() == 1) {
            throw new Exception("Questo utente esiste già!");
        }
    } catch (Exception $e) {
        header($_SERVER['SERVER_PROTOCOL'] . " 504 " . $e->getMessage());
        die($e->getMessage());
    }

    try {
        $binding = $conn->prepare("INSERT INTO account VALUES(:name, :username, :password, :creation_time, :role)");
        $binding->bindParam(":name", $name, PDO::PARAM_STR);
        $binding->bindParam(":username", $username, PDO::PARAM_STR);
        $binding->bindParam(":password", $password, PDO::PARAM_STR);
        $binding->bindParam(":creation_time", $dt, PDO::PARAM_STR);
        $binding->bindParam(":role", $role, PDO::PARAM_STR);
        $binding->execute();
    } catch (PDOException $e) {
        header($_SERVER['SERVER_PROTOCOL'] . " 501 " . $e->getMessage());
        die($e->getMessage());
    }

    if (session_start()) {
        $_SESSION["username"] = $username;
        echo json_encode(array("Success", $_SESSION["username"]));
    } else {
        try {
            throw new Exception("Errore nella creazione della sessione");
        } catch (Exception $e) {
            header($_SERVER['SERVER_PROTOCOL'] . " 502 " . $e->getMessage());
            die($e->getMessage());
        }
    }
} else {
    try {
        throw new Exception("Inserire tutti i dati.");
    } catch (Exception $e) {
        header($_SERVER['SERVER_PROTOCOL'] . " 503 " . $e->getMessage());
        die($e->getMessage());
    }
}
