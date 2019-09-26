<?php
include "../modele/salles.php";
supprimerSalle($_GET["salle"]);
header('Location: ../controleurs/choixSalle.php');