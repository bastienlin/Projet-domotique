<?php
include "../modele/capteurs.php";
include "../modele/salles.php";
include "../modele/security.php";

session_start();
checkSession();

$type = getTypeUtilisateur($_SESSION['idUtilisateur']);
if ($type == 'gestionnaire' OR $type == 'personnel') {

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

    function actionneurChange($id)
    {
        echo 'change';
    }

    include "../vues/gestionCapteurView.php";

} else {
    header('Location: ../vues/accesRefuse.php');
}

