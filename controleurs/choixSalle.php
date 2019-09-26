<?php

include "../modele/salles.php";
include "../modele/laboratoires.php";
include('../modele/security.php');

session_start();
checkSession();

$type = getTypeUtilisateur($_SESSION['idUtilisateur']);

if ($type == 'gestionnaire' OR $type == 'personnel') {

    function afficheSalleBoutons()
    {
        $result = returnsalle();
        foreach ($result as $row) {
            echo "\n";
            if ($_SESSION["type_employe"] == "gestionnaire") {
                echo('<li class="bloc"> <a href="../controleurs/supprimerSalle.php?salle=' . $row["idPieces"] . '"><img src="../Images/suppr.png" id="image"> </a>');
            } else {
                echo('<li class="bloc">');
            }
            if ($row["type_piece"] == "analyse") {
                echo(' <a href="../controleurs/gestionSalle.php?salle=' . $row["idPieces"] . ' " class="nomSalle" > <img src="../Images/iconelab.png" alt="" /> <br>' . $row["nom"] . '</a></li>');
            } elseif ($row["type_piece"] == "prelevement") {
                echo ' <a href="../controleurs/gestionSalle.php?salle=' . $row["idPieces"] . ' " class="nomSalle" > <img src="../Images/Seringue.png" alt="" /> <br>' . $row["nom"] . '</a></li>';
            } else {
                echo ' <a href="../controleurs/gestionSalle.php?salle=' . $row["idPieces"] . ' " class="nomSalle" > <img src="../Images/Reserve.png" alt="" /> <br>' . $row["nom"] . '</a></li>';
            }
        }
    }

    include "../vues/choixSalleView.php";
} else {
    header('Location: ../vues/accesRefuse.php');
}






