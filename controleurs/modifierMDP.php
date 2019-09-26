<?php
include('../modele/security.php');

session_start();
checkSession();
$mdpErr = $longErr = $succes = "";

// on execute le modele et les fonctions qui en découle uniquement si le champ post est rempli
if (isset($_POST['oldmdp']) and isset($_POST['newmdp']) and isset($_POST['newmdpverif'])) {
    include("../modele/modificationModel.php");
    if ($_POST['newmdp'] == $_POST['newmdpverif']) {
        if (strlen($_POST['newmdp']) > 7) {
            if (verifpassword($_POST['oldmdp'])) {
                $succes = modifmdp();
            } else {
                $mdpErr = "mot de passe incorrect";
            }
        } else {
            $longErr = "vous devez choisir un mot de passe de 8 caractère ou plus";
        }

    }
}

include "../vues/modifmdp.php";