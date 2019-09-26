<?php

$mailissent = "";
if (isset($_POST['lastname'])) {
    include("../modele/reinitialisationModele.php");
}
include "../vues/reinitialisation.php";



