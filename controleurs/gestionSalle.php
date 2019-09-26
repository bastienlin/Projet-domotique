<?php

include('../modele/security.php');

session_start();
checkSession();

if (controleAccesSalle($_SESSION['idLaboratoire'], $_GET['salle'], $_SESSION['idUtilisateur'])) {


    include "../modele/salles.php";
    function afficheSallesMenu()
    {
        $result = returnsalle();
        foreach ($result as $row) {
            echo "\n";
            if($row["idPieces"] == $_GET['salle']){
                echo('<li><a href="../controleurs/gestionSalle.php?salle=' . $row["idPieces"] . '" class="navMenuStrong" > ' . $row["nom"] . '</a></li>');
            }
            else{
                echo('<li><a href="../controleurs/gestionSalle.php?salle=' . $row["idPieces"] . '" class="navMenu" > ' . $row["nom"] . '</a></li>');
            }

        }
        echo "\n";

    }

    include "../modele/capteurs.php";

    include "../vues/gestionSalleView.php";

} else {

    header('Location: ../vues/accesRefuse.php');
}