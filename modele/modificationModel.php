<?php


$oldmdp = $_POST['oldmdp'];
$newpassword = $_POST['newmdp'];
$verif = $_POST['newmdpverif'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mvc";


function verifpassword($password)
{

    $username = "root";
// Create connection

    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }


    $req = $conn->prepare("SELECT * FROM utilisateurs WHERE adresse_mail=?");
    $req->execute(array(htmlspecialchars($_SESSION["adresse_mail"])));
    $row = $req->fetch();
    $mdpverif = $row["mot_de_passe"];
    $cryptedpassword = customCrypt($password);
    if (strcmp($cryptedpassword, $mdpverif) == 0) {
        return true;
    } else {
        $mdpErr = "mot de passe incorrect";
        return false;
    }


}

function modifmdp()
{
    $newpassword = $_POST['newmdp'];
    $username = "root";
    $password = "";


    try {
        $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }





    $sql = "UPDATE utilisateurs SET mot_de_passe=? WHERE adresse_mail=?";
    $req = $conn->prepare($sql);
    $req->execute(array(customCrypt($newpassword), htmlspecialchars($_SESSION["adresse_mail"])));

    return "votre mot de passe a été modifié";


    }