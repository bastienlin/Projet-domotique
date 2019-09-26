<?php
include "../modele/capteurs.php";
supprimerCapteur($_GET["capteur"]);

header("Location:../controleurs/gestionSalle.php?salle=" . $_GET["salle"]);

