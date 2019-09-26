<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../CSS/Gestion_salle.css"/>
    <link rel="stylesheet" href="../CSS/Header_Footer.css"/>
    <title>Salle d'analyse</title>
</head>


<body>
<?php
$titrePage = "Gestion Salle : " . returnNameSalle($_GET['salle']);
include "header.php";
?>

<script>
    function getXMLHttpRequest() {
        var xhr = null;

        if (window.XMLHttpRequest || window.ActiveXObject) {
            if (window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            } else {
                xhr = new XMLHttpRequest();
            }
        } else {
            alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
            return null;
        }
        return xhr;
    }

    function actionneurChange(id) {
        var xhr = getXMLHttpRequest();

        xhr.open("POST", "../modele/changeValActionneur.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        if (document.getElementById(id).checked) {
            xhr.send("id_capteur=" + id + "&valeur=1");
        } else {
            xhr.send("id_capteur=" + id + "&valeur=0");
        }
    }
</script>

<section>
    <div class="main">
        <?php
        $result = returncapteurs();
        foreach ($result as $row) {
            echo "\n";


            if ($row["capteur_type"] == "lumiere") {
                echo('<div class="text_reglage_auto"> 
                 <img src="../Images/Lumière.png" class="ico_categorie" align="absmiddle" />  Lumière 
                    <label class="switch">
                        <input type="checkbox" id="' . $row["id_capteur"] . '" onchange= "actionneurChange(' . $row["id_capteur"] . ')"');
                if (getValsActionneur($row["id_capteur"]) == 1) {
                    echo 'checked=true';
                }
                echo('>
                        <span class="slider round"></span>
                    </label>');
                if ($_SESSION["type_employe"] == "gestionnaire") {

                    echo('<a href="../controleurs/supprimerCapteur.php?salle=' . $_GET["salle"] . '&capteur=' . $row["id_capteur"] . '" ><img src="../Images/suppr.png" alt="" class="imgSuppr" ></a>');
                }
                echo('</div> ');


            } elseif ($row["capteur_type"] == "temperature") {
                echo '<div>
                    <a href="../controleurs/gestionCapteur.php?salle=' . $_GET["salle"] . '&capteur=' . $row["id_capteur"] . '"><img src="../Images/Termomètre.png" class="ico_categorie" alt="" align="absmiddle" /> Température : </a>';
                echo'<h id="temp">'.getDerniereMesure($row["id_capteur"]).' </h><h> °C</h>';

                if ($_SESSION["type_employe"] == "gestionnaire") {

                    echo('<a href="../controleurs/supprimerCapteur.php?salle=' . $_GET["salle"] . '&capteur=' . $row["id_capteur"] . '" ><img src="../Images/suppr.png" alt="" class="imgSuppr" ></a>');
                }
                echo('</div> ');
                echo('<script>

                window.onload = function () {
                    function actualiseTemperature(id) {
                        var xhr = getXMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                                document.getElementById("temp").innerText = xhr.responseText;
                            }
                        };

                        xhr.open("POST", "../modele/getValueCapteur.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send("id_capteur=" + id);
                    }
                    function actualisation() {
                        setTimeout(function () {
                        actualiseTemperature('.$row["id_capteur"].');
                actualisation();
            }, 3000)
        }

                    actualisation();

                }
    </script>');
                echo '<script>var h = document.getElementById(\'temp\').textContent;if (h == " "){
                    window.alert("Aucune donnée reçue, il est possible que vous ayez mal configuré votre capteur.  \n" +
                        "Si vous n\'arrivez pas à la faire fonctionner merci de contacter le service client.");
                }</script>';


            } elseif ($row["capteur_type"] == "securite") {
                echo '        <div class="text_reglage_auto"> 
                  <img src="../Images/Sécurité.png" alt="" class="ico_categorie" align="absmiddle" /> Sécurité
                    <label class="switch">
                        <input type="checkbox" id="' . $row["id_capteur"] . '" onchange= "actionneurChange(' . $row["id_capteur"] . ')"';
                if (getValsActionneur($row["id_capteur"]) == 1) {
                    echo 'checked=true';
                }
                echo('>
                        <span class="slider round"></span>
                    </label>');
                if ($_SESSION["type_employe"] == "gestionnaire") {

                    echo('<a href="../controleurs/supprimerCapteur.php?salle=' . $_GET["salle"] . '&capteur=' . $row["id_capteur"] . '" ><img src="../Images/suppr.png" alt="" class="imgSuppr" ></a>');
                }
                echo('</div> ');

                if ((getDerniereMesure($row["id_capteur"]) == 1) and (getValsActionneur($row["id_capteur"]) == 1)) {
                    echo "\n";
                    echo " <script> window.alert('Intrusion détectée'); </script> ";
                    echo "\n";
                }
            }
        }
        echo "\n";
        ?>

    </div>

    <div>
        <?php
        if ($_SESSION["type_employe"] == "gestionnaire") {
            echo('<a href="../controleurs/ajoutCapteur.php?salle=' . $_GET["salle"] . '" class="bouton_ajout"> <img src="../Images/Plus.png" class="ajout" alt="" /> Ajouter un capteur</a>
            ');
        } ?>
    </div>




    <nav>
        <ul class="menu">
            <h3 class="titreMenu">PIECES</h3>
            <?php afficheSallesMenu(); ?>
            <h3 class="titreMenu">Options</h3>
            <?php
            if ($_SESSION["type_employe"] == "gestionnaire") {
                echo('<li><a href="../controleurs/ajoutSalle.php" class="navMenu">Ajouter une salle </a></li>');
            } ?>
            <li><a href="../controleurs/choixSalle.php" class="navMenu">Retour</a></li>
        </ul>
    </nav>


</section>
</div>

<?php
include "footer.php";
?>
</body>
</html>

