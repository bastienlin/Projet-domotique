<?php

include "../modele/laboratoires.php";
include('../modele/security.php');

session_start();
checkSession();

$type = getTypeUtilisateur($_SESSION['idUtilisateur']);

if ($type == 'gestionnaire' OR $type == 'administrateur') {

    function afficheInfosGenerales()
    {
        $idLab = $_SESSION["idLaboratoire"];
        if ($idLab != 0) {
            echo '<h2>Mon Laboratoire</h2>
                    Nom : ' . getNameLaboratoire($idLab) . '
            <br /> <br /> ';
        } else {
            echo '<h2>Statistiques</h2><br /> <br />';
            echo 'Nombre de Laboratoires :  ' . getNumLabs() . '
        <br /> <br />  ';
        }
        echo '
                    Nombre d&#8217;employés : ' . getNumEmployes($idLab) . '

            <br /> <br /> 
                    Nombre de Salles :  ' . getNumSalles($idLab) . '
            <br /> <br /> 

                    Nombre de Capteurs :  ' . getNumCapteurs($idLab) . '
            <br /> <br /> ';
    }

    include "../vues/informationGeneralesView.php";

} else {
    header('Location: ../vues/accesRefuse.php');
}
