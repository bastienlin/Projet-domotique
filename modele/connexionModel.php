<?php

include('security.php');

$username = "root";
$password = "";

$email_sent = $_POST['email'];
$password_sent = customCrypt($_POST['password']);


// Create connection

try {
    $conn = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$req = $conn->prepare("SELECT * FROM utilisateurs WHERE adresse_mail=?");
$req->execute(array(htmlspecialchars($email_sent)));
$row = $req->fetch();

if ($row["adresse_mail"] != null) {
    if (strcmp($password_sent, $row["mot_de_passe"]) == 0) {
        $_SESSION["nom_utilisateur"] = $row["nom_utilisateur"];
        $_SESSION["idUtilisateur"] = $row["idUtilisateurs"];
        $_SESSION["adresse_mail"] = $row["adresse_mail"];
        $_SESSION["type_employe"] = $row["type_employe"];
        $_SESSION["idLaboratoire"] = $row["idLaboratoire"];
        if (strcmp("gestionnaire", $row["type_employe"]) == 0) {
            header('Location: ../vues/menu.php');
        } else if (strcmp("administrateur", $row["type_employe"]) == 0) {
            header('Location: ../vues/menu.php');
        } else {
            header('Location: ../controleurs/choixSalle.php');
        }
        exit();
    } else {
        $erreur = "Mot de Passe Incorrect";
    }
} else {
    $erreur = "Mail Inconnu";
}

?>