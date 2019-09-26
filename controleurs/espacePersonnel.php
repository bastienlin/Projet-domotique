<?php

include "../modele/laboratoires.php";
include('../modele/security.php');
session_start();
checkSession();

function afficheInfosUtilisateur()
{
    echo '<h2>Mes informations personnelles</h2>
                    Nom : ' . $_SESSION["nom_utilisateur"] . '
            <br /> <br /> <br />
                    Adresse e-mail :  ' . $_SESSION["adresse_mail"] . '
            <br /> <br /> <br />
                    Mon laboratoire :  ' . getNameLaboratoire($_SESSION["idLaboratoire"]) . '
            <br /> <br /> <br />
            <a style="text-decoration:none" href="../controleurs/modifierMDP.php" class="italic">Modifier le mot de passe</a>';
}

include "../vues/espacePersonnelView.php";
?>