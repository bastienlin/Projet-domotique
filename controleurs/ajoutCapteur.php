<?php

include('../modele/security.php');
session_start();
checkSession();
if (controleAccesSalle($_SESSION['idLaboratoire'], $_GET['salle'], $_SESSION['idUtilisateur']) AND getTypeUtilisateur($_SESSION['idUtilisateur']) == 'gestionnaire') {

    if (isset($_POST["typeCapteur"])) {
        include("../modele/capteurs.php");
        $message = ajoutCapteur();
    }

    include "../vues/ajoutCapteurView.php";
} else {
    header('Location: ../vues/accesRefuse.php');
}