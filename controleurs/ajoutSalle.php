<?php

include('../modele/security.php');
session_start();
checkSession();

if (getTypeUtilisateur($_SESSION['idUtilisateur']) == 'gestionnaire') {

    $nameErr = "";
    if (isset($_POST["nomSalle"]) and empty($_POST["nomSalle"])) {
        $nameErr = "Vous devez donner un nom à la salle";
    } elseif (isset($_POST["nomSalle"]) and isset($_POST["typeSalle"])) {
        include("../modele/salles.php");
        $message = ajoutsalle();
    }

    include "../vues/ajoutSalleView.php";

} else {
    header('Location: ../vues/accesRefuse.php');
}