<?php
include "../modele/utilisateurs.php";
supprimerUtilisateur($_GET["id"]);
header('Location: ../controleurs/infosEmployes.php');