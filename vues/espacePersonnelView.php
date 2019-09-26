<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/espace_personnel.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Accueil</title>
</head>


<body>

<?php
$titrePage = "Mon espace personnel";
include "header.php";
?>
<div class="outer-div">
    <div class="inner-div">
        <?php afficheInfosUtilisateur(); ?>

    </div>
</div>
<?php
include "footer.php";
?>
</body>