<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/ajoutSalle.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Laboratoire</title>
</head>

<body>


<?php
$titrePage = "Ajouter un Capteur";
include "header.php";
?>

<a href="../controleurs/gestionSalle.php?salle=<?php echo $_GET["salle"] ?>"> <input type="button" id="retour"></a>

<div class="container">
    <div style="text-align:center" style="font-size: 20px;">
        <form method="post" action=<?php echo('..\controleurs\ajoutCapteur.php?salle=' . $_GET["salle"]); ?>>
            <br>
            <label for="typeCapteur">Type de capteur</label>
            <select id="typeCapteur" name="typeCapteur">
                <option value="temperature">Température</option>
                <option value="lumiere">Lumière</option>
                <option value="securite">Sécurité</option>
            </select>
            <br> <br> <br> <br> <br>
            <input type="submit" value="Ajouter">
        </form>
        <?php
        if (isset($message)) {
            echo "<br><h>" . $message . "</h>";
        }
        ?>
    </div>

    <?php
    include "footer.php";
    ?>

</body>
</html>
