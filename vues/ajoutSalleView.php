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
$titrePage = "Ajouter une Salle";
include "header.php";
?>

<a href="../controleurs/choixSalle.php"> <input type="button" id="retour"></a>


<div class="container">

    <div style="text-align:center">
        <form method="post" action="..\controleurs\ajoutSalle.php">
            <label for="nomSalle">Nom de la salle</label>
            <input type="text" id="nomSalle" name="nomSalle">
            <span class="error"><?php if (isset($nameErr)) {
                    echo $nameErr . '<br>';
                } ?></span>
            <br> <br> <br>

            <label for="typeSalle">Type de salle</label>
            <select id="typeSalle" name="typeSalle">
                <option value="analyse">Analyse</option>
                <option value="prelevement">Prélèvement</option>
                <option value="reserve">Réserve</option>
                <option value="autre">Autre</option>
            </select>
            <br> <br> <br> <br>
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
