<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/Choix_Salle.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Accueil</title>
</head>


<body>

<?php
$titrePage = getNameLaboratoire($_SESSION["idLaboratoire"]);
include "header.php";
?>

<section>
    <div class="main">

        <p class="text1">Veuillez-choisir la salle à contrôler :</p>

        <ul class="column">
            <?php afficheSalleBoutons(); ?>
        </ul>

    </div>

    <div>
        <?php
        if ($_SESSION["type_employe"] == "gestionnaire") {
            echo('<a href="../controleurs/ajoutSalle.php" class="bouton_ajout"> <img src="../Images/Plus.png" class="ajout" alt="" /> Ajouter une salle </a>');
        } ?>
    </div>

</section>

<?php
include "footer.php";
?>
</body>
</html>
