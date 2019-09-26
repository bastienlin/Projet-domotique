<?php
session_start();
if (isset($_POST['email']) and isset($_POST['password'])) {
    include "../modele/connexionModel.php";
}
include "../vues/connexionView.php";
?>