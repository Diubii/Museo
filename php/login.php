<?php
include('methods.php');

$loginData = json_decode($_POST["loginData"]);
$username = $loginData -> username;
$password = $loginData -> password;

if(isset($username) && isset($password)){
    $dbservername="database.diubi.dev";
    $dbusername="managermuseo";
    $dbpassword="museokyoto";

    $conn = ConnectToDefaultDatabase($dbservername, $dbusername, $dbpassword);

    try{
        $result = $conn -> query("SELECT username, password FROM account WHERE username = '$username'");
        $row = $result -> fetch();
    }
    catch(PDOException $e){
        header($_SERVER['SERVER_PROTOCOL'] . "Errore durante l\'inserimento dati nel database. Riprovare.");
        die("Errore durante l'inserimento dati nel database. Riprovare.");
    }

    if($result -> rowCount() <= 0){
        try{
            throw new Exception("Questo utente non esiste.");
        }
        catch(Exception $e){
            header($_SERVER['SERVER_PROTOCOL'] . " 501 " . $e -> getMessage());
            die($e -> getMessage());
        }
    }

    if($row["password"] == $password){
       
        if(session_start()){
            $_SESSION["username"] = $username;
            echo json_encode(array("Success", $_SESSION["username"]));
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
            throw new Exception("Password errata.");
        }
        catch(Exception $e){
            header($_SERVER['SERVER_PROTOCOL'] . " 502 " . $e -> getMessage());
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

?>