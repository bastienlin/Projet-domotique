<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/menuGestionnaire.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Accueil</title>
</head>


<body>

<?php
$titrePage = "Bienvenue !";
session_start();
include "header.php";
?>

<section>
    <div class="main">

        <p class="text1">Veuillez-choisir l'action à réaliser :</p>

        <ul class="column">
            <?php
            if (strcmp($_SESSION["type_employe"], "gestionnaire") == 0) {
                echo '<li class="bloc"><a href="../controleurs/choixSalle.php" class="text2" > <img src="../Images/iconelab.png" alt="" /> <br/> Gestion Laboratoire </a></li>
                <li class="bloc"><a href="../controleurs/infosEmployes.php" class="text2" > <img src="../Images/employes.png" alt="" /> <br/> Informations Employés </a></li>
                <li class="bloc"><a href="../controleurs/infosGenerales.php" class="text2" > <img src="../Images/infoLab.png" alt="" />  <br/> Informations du Laboratoire </a></li>';

            } else {
                echo '<li class="bloc"><a href="../controleurs/infosEmployes.php" class="text2" > <img src="../Images/employes.png" alt="" /> <br/> Informations Employés </a></li>
            <li class="bloc"><a href="../controleurs/infosGenerales.php" class="text2" > <img src="../Images/infoLab.png" alt="" />  <br/> Informations Générales </a></li>';
            }
            ?>
        </ul>

    </div>


</section>

<?php
include "footer.php";
?>
</body>
</html>