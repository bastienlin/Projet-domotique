<?php
include "../modele/utilisateurs.php";
include "../modele/laboratoires.php";
include "../modele/security.php";
session_start();
checkSession();

$type = getTypeUtilisateur($_SESSION['idUtilisateur']);

if ($type == 'gestionnaire' OR $type == 'administrateur') {

    function afficheTableUtilisateurs()
    {
        $result = returnutilisateursLab();
        foreach ($result as $row) {
            echo "\n";
            echo('<TR>
                <TD>' . $row["nom_utilisateur"] . '  </TD> <TD>' . $row["adresse_mail"] . '</TD><TD>' . $row["type_employe"] . '</TD> <TD>' . getNameLaboratoire($row["idLaboratoire"]) . '</TD><TD><a href="../controleurs/supprimerUtilisateur.php?id=' . $row["idUtilisateurs"] . '">  <img src="../Images/suppr.png" alt="" class="imgSuppr"/></a></TD></TR>');
        }
    }

    include "../vues/InfosEmployesView.php";

} else {
    header('Location: ../vues/accesRefuse.php');
}