<?php

//header('Location: initialiseUtilisateurs.php');

session_start();
if (isset($_SESSION["type_employe"])) {
    if ($_SESSION["type_employe"] == "gestionnaire") {
        header('Location: vues/menu.php');
    } elseif ($_SESSION["type_employe"] == "administrateur") {
        header('Location: vues/menu.php');
    } else {
        header('Location: controleurs/choixSalle.php');
    }
} else {
    header('Location: controleurs/connexion.php');
}

?>