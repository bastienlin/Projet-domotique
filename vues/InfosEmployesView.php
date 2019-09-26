<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/infosEmployes.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Employés</title>
</head>


<body>


<?php
$titrePage = "Informations employés";
include "header.php";
?>

<div id="bloc_page2">
    <TABLE>
        <TR>
            <TH class="titreColonne">Nom</TH>
            <TH class="titreColonne">Mail</TH>
            <TH class="titreColonne">Fonction</TH>
            <TH class="titreColonne">Laboratoire de Travail</TH>
            <TH></TH>
            <?php afficheTableUtilisateurs(); ?>
    </TABLE>
    <br/>
    <a href="../controleurs/inscription.php" class="bouton_ajout">Nouvel Utilisateur</a>
</div>
</body>
<?php
include "footer.php";
?>
</html>
