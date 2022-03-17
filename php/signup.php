<?php
include('methods.php');

$signupData = json_decode($_POST["signupData"]);
$name = $signupData -> name;
$username = $signupData -> username;
$password = $signupData -> password;

if(isset($name) && isset($username) && isset($password)){
    $dbservername="database.diubi.dev";
    $dbusername="managermuseo";
    $dbpassword="museokyoto";

    $conn = ConnectToDatabase($dbservername, $dbusername, $dbpassword);

    try{
        $binding = $conn -> prepare("INSERT INTO account VALUES(:name, :username, :password)");
        $binding -> bindParam(":name", $name, PDO::PARAM_STR);
        $binding -> bindParam(":username", $username, PDO::PARAM_STR);
        $binding -> bindParam(":password", $password, PDO::PARAM_STR);
        $binding -> execute();
    }
    catch(PDOException $e){
        echo "<script>console.log(" . $e->getMessage() . ")</script>";
        header($_SERVER['SERVER_PROTOCOL'] . "Errore durante l\'inserimento dati nel database. Riprovare.");
        die("Errore durante l'inserimento dati nel database. Riprovare.");
    }
               
    if(session_start()){
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        echo json_encode("Success");
    }
    else{
        try{
            throw new Exception("Errore nella creazione della sessione");
        }
        catch(Exception $e){
            header($_SERVER['SERVER_PROTOCOL'] . " 500 " . $e -> getMessage());
            die($e -> getMessage());
        }
    }
}
else{
    try{
        throw new Exception("Inserire tutti i dati.");
    }
    catch(Exception $e){
        header($_SERVER['SERVER_PROTOCOL'] . " 500 " . $e -> getMessage());
        die($e -> getMessage());
    }
    
}
